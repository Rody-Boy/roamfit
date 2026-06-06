# Deploying RoamFit on Vercel

Vercel should deploy the **Next.js web app** in `apps/web`. The NestJS API in `apps/api` is a serverful backend designed for ECS Fargate or another long-running Node runtime, not the default Vercel static/Next build pipeline.

## Why Vercel warned that it could not identify the Next.js version

Vercel identifies the framework and Next.js version by reading the `package.json` at the configured project root. RoamFit is an npm-workspace monorepo, and the actual Next.js dependency lives in `apps/web/package.json`. If the Vercel project root is the repository root, Vercel can run the workspace build command, but its framework detector may still warn:

```text
Warning: Could not identify Next.js version, ensure it is defined as a project dependency.
```

That warning means Vercel did not find `next` in the package manifest it used for detection. It does **not** mean `apps/web` lacks Next.js. The repository now mirrors `next`, `react`, and `react-dom` in the root dev dependencies so repository-root Vercel projects can identify the framework version before following workspaces.

## Recommended Vercel settings

### Option A: repository-root deployment

Use this option if the Vercel project root is the repository root. The root `vercel.json` mirrors these settings.

- Framework preset: Next.js
- Root directory: repository root
- Install command: `npm install`
- Build command: `npm --workspace @roamfit/web run build`
- Output directory: `apps/web/.next`

### Option B: web-app root deployment

Use this option if you configure Vercel's monorepo Root Directory setting to `apps/web`.

- Framework preset: Next.js
- Root directory: `apps/web`
- Install command: `npm install`
- Build command: `npm run build`
- Output directory: `.next`

Do not point Vercel at `apps/api`; deploy the NestJS API to ECS Fargate or another long-running Node runtime.


## Build failures found during review

A production `next build` requires every App Router page to have a root layout. The initial web scaffold had `apps/web/app/page.tsx` but did not include `apps/web/app/layout.tsx`, which causes this build error:

```text
page.tsx doesn't have a root layout. To fix this error, make sure every page has a root layout.
```

The web app now includes `apps/web/app/layout.tsx` with the required `<html>` and `<body>` wrapper and metadata.

Next.js also type-checks TypeScript apps during production builds. If `@types/react` and `@types/react-dom` are not installed, Next.js tries to auto-install them during the build. In locked-down CI environments that cannot fetch packages, this can fail. RoamFit declares those type packages in `apps/web/package.json` so a normal `npm install` installs them before `next build`.

## About TS1241 / TS1270 decorator errors

NestJS uses TypeScript's legacy decorator mode for decorators such as `@Controller()` and `@Get()`. If a tool compiles `apps/api/src/auth/auth.controller.ts` without the RoamFit tsconfig chain, TypeScript uses the newer standard decorator call signature and reports errors such as:

- `TS1241: Unable to resolve signature of method decorator when called as an expression`
- `TS1270: Decorator function return type ... is not assignable`

The fix is **not** to change the controller method. The fix is to ensure the API is compiled through `apps/api/tsconfig.json` or `apps/api/tsconfig.build.json`, both of which inherit `experimentalDecorators` and `emitDecoratorMetadata` from `tsconfig.base.json`.

## Local verification

Run these commands from the repository root after dependencies are installed:

```bash
npm run doctor:decorators
npm --workspace @roamfit/api run typecheck
```

If you invoke TypeScript directly with a file path, for example `tsc apps/api/src/auth/auth.controller.ts`, TypeScript may ignore the project config and reproduce TS1241/TS1270. Always use `tsc -p apps/api/tsconfig.json` or the workspace script instead.
