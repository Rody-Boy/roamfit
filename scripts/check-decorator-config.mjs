import { readFileSync } from 'node:fs';
import { resolve } from 'node:path';

function readJson(path) {
  return JSON.parse(readFileSync(resolve(path), 'utf8'));
}

const base = readJson('tsconfig.base.json');
const api = readJson('apps/api/tsconfig.json');
const build = readJson('apps/api/tsconfig.build.json');
const nest = readJson('apps/api/nest-cli.json');

const compilerOptions = base.compilerOptions ?? {};
const failures = [];

if (compilerOptions.experimentalDecorators !== true) {
  failures.push('tsconfig.base.json must set compilerOptions.experimentalDecorators to true for NestJS decorators.');
}

if (compilerOptions.emitDecoratorMetadata !== true) {
  failures.push('tsconfig.base.json must set compilerOptions.emitDecoratorMetadata to true for NestJS metadata reflection.');
}

if (api.extends !== '../../tsconfig.base.json') {
  failures.push('apps/api/tsconfig.json must extend ../../tsconfig.base.json so @Controller/@Get use legacy decorator typing.');
}

if (build.extends !== './tsconfig.json') {
  failures.push('apps/api/tsconfig.build.json must extend ./tsconfig.json so Nest builds inherit decorator settings.');
}

if (nest.compilerOptions?.tsConfigPath !== 'tsconfig.build.json') {
  failures.push('apps/api/nest-cli.json must point Nest CLI at tsconfig.build.json.');
}

if (failures.length) {
  console.error(failures.join('\n'));
  process.exit(1);
}

console.log('Decorator configuration validation passed.');
