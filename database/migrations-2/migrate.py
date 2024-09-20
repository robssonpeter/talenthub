import os

BUFFER_SIZE = 1000
ext = ".php"
pattern = "Schema::create('"
replace_format = "if not Schema::hasTable('{0}'):\\n\\t\\t\\tSchema::create('{0}', function"

# Open current working directory
with os.scandir() as dir:
    for entry in dir:
        # Check if file has .php extension
        if entry.name.endswith(ext) and entry.is_file():
            # Process file
            with open(entry.path, 'r+') as fp:
                buffer = fp.readlines()
                fp.seek(0)

                for line in buffer:
                    pos = line.find(pattern)
                    if pos != -1:
                        # Extract table name from string
                        table_name = line[pos+len(pattern):].split("'")[0]

                        # Replace pattern with new string
                        replace = replace_format.format(table_name)
                        line = line[:pos] + replace + line[pos+len(pattern):]

                    fp.write(line)

                fp.truncate()
