import json
import yaml
import sys

# Revisa si se proporcionaron argumentos en la línea de comando
if len(sys.argv) < 3:
    print("Uso: python json2yaml.py [input.json] [output.yaml]")
    sys.exit(1)

# Abre y lee el archivo JSON
with open(sys.argv[1], 'r') as json_file:
    data = json.load(json_file)

# Abre y escribe el archivo YAML
with open(sys.argv[2], 'w') as yaml_file:
    yaml.dump(data, yaml_file, default_flow_style=False)
