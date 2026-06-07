variable "name_prefix" { type = string }

# TODO: Expand ecs resources for production. This module boundary is intentional
# so environments can promote from scaffold to hardened infrastructure without
# changing the root Terraform contract.

output "module_name" {
  value = "${var.name_prefix}-ecs"
}
