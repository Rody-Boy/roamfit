FROM node:22-alpine AS base
WORKDIR /app
COPY package.json package-lock.json* ./
COPY apps/api/package.json apps/api/package.json
RUN npm install --workspaces --include-workspace-root || true
COPY . .
EXPOSE 3000
CMD ["npm", "--workspace", "@roamfit/api", "run", "start:dev"]
