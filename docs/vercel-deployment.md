# Deploying RoamFit on Vercel

Vercel should deploy the **Next.js web app** in `apps/web`. The NestJS API in `apps/api` is a serverful backend designed for ECS Fargate or another long-running Node runtime, not the default Vercel static/Next build pipeline.

## Recommended Vercel settings

- Framework preset: Next.js
- Root directory: repository root, or `apps/web` if using Vercel's monorepo UI
- Build command from repository root: `npm --workspace @roamfit/web run build`
- Output directory from repository root: `apps/web/.next`
- Install command: `npm install`

The root `vercel.json` mirrors these settings for repository-root deployments.

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
