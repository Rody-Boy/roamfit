import { existsSync, readFileSync } from 'node:fs';

const required = [
  'docs/product-requirements.md',
  'docs/system-architecture.md',
  'docs/api-specification.md',
  'docs/security-architecture.md',
  'docs/implementation-roadmap.md',
  'apps/api/prisma/schema.prisma',
  'apps/api/src/main.ts',
  'apps/web/app/page.tsx',
  'apps/mobile/src/App.tsx',
  'infra/terraform/main.tf',
  'docker-compose.yml',
  '.github/workflows/ci.yml',
  'tsconfig.base.json',
  'apps/api/tsconfig.json',
  'apps/web/tsconfig.json',
  'vercel.json',
];

const missing = required.filter((file) => !existsSync(file));
if (missing.length) {
  console.error(`Missing required files:\n${missing.join('\n')}`);
  process.exit(1);
}

const prisma = readFileSync('apps/api/prisma/schema.prisma', 'utf8');
const requiredModels = [
  'User', 'UserProfile', 'FitnessProfile', 'Facility', 'FacilityOwner',
  'FacilityStaff', 'Amenity', 'Equipment', 'Service', 'CreditLedger',
  'CreditPackage', 'Transaction', 'Purchase', 'CheckIn', 'Review',
  'Reward', 'FitPointLedger', 'Level', 'Challenge', 'ChallengeCompletion',
  'Streak', 'FitnessPassport', 'Notification', 'Promotion', 'Payout',
  'FraudEvent', 'AuditLog', 'Role', 'Permission', 'Session', 'Device'
];

const missingModels = requiredModels.filter((model) => !new RegExp(`model\\s+${model}\\s+{`).test(prisma));
if (missingModels.length) {
  console.error(`Missing Prisma models:\n${missingModels.join('\n')}`);
  process.exit(1);
}

const docs = readFileSync('docs/product-requirements.md', 'utf8');
if (!docs.includes('RoamFit') || docs.includes('FitPass PH is the product name')) {
  console.error('Product requirements must use RoamFit as the product name.');
  process.exit(1);
}

console.log('Repository scaffold validation passed.');
