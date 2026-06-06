terraform {
  required_version = ">= 1.7.0"
  required_providers {
    aws = { source = "hashicorp/aws", version = "~> 5.0" }
  }
}

provider "aws" {
  region = var.aws_region
}

module "network" {
  source      = "./modules/network"
  name_prefix = var.name_prefix
}

module "storage" {
  source      = "./modules/storage"
  name_prefix = var.name_prefix
}

module "security" {
  source      = "./modules/security"
  name_prefix = var.name_prefix
}

module "rds" {
  source      = "./modules/rds"
  name_prefix = var.name_prefix
}

module "redis" {
  source      = "./modules/redis"
  name_prefix = var.name_prefix
}

module "opensearch" {
  source      = "./modules/opensearch"
  name_prefix = var.name_prefix
}

module "ecs" {
  source      = "./modules/ecs"
  name_prefix = var.name_prefix
}

module "observability" {
  source      = "./modules/observability"
  name_prefix = var.name_prefix
}
