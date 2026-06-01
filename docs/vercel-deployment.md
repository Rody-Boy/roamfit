# Deploying RoamFit on Vercel

Vercel should deploy the **Next.js web app** in `apps/web`. The NestJS API in `apps/api` is a serverful backend designed for ECS Fargate or another Node runtime, not the default Vercel static/Next build pipeline.

## Recommended Vercel settings

- Framework preset: Next.js
- Root directory: repository root, or `apps/web` if using Vercel's monorepo UI
- Build command from repository root: `npm --workspace @roamfit/web run build`
- Output directory from repository root: `apps/web/.next`
- Install command: `npm install`

The root `vercel.json` mirrors these settings for repository-root deployments.

## About TS1241 / TS1270 decorator errors

NestJS uses legacy TypeScript decorators such as `@Controller()` and `@Get()`. If TypeScript compiles `apps/api` without `experimentalDecorators`, it interprets decorators using the newer standard decorator signature and reports errors such as:

- `TS1241: Unable to resolve signature of method decorator when called as an expression`
- `TS1270: Decorator function return type ... is not assignable`

The fix is to compile NestJS with a tsconfig that enables `experimentalDecorators` and `emitDecoratorMetadata`. RoamFit now defines those options in `tsconfig.base.json`, and the API extends them through `apps/api/tsconfig.json`.
