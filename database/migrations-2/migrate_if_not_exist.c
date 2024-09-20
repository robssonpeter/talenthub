#include <stdio.h>
#include <string.h>
#include <dirent.h>

#define BUFFER_SIZE 1000
#define FILE_EXTENSION ".php"
#define SEARCH_STRING "Schema::create('"
#define REPLACE_STRING "if (!Schema::hasTable('%s')) \n"

int main() {
    DIR *dir;
    struct dirent *entry;
    char path[1024];

    // Open current working directory
    dir = opendir(".");
    if (!dir) {
        printf("Error: could not open current directory\n");
        return 1;
    }

    // Loop through entries in directory
    while ((entry = readdir(dir)) != NULL) {
        // Check if entry is a file and has .php extension and "create" in its name
        if (entry->d_type == DT_REG && strstr(entry->d_name, "create") != NULL && strstr(entry->d_name, FILE_EXTENSION) != NULL) {
            // Process file
            sprintf(path, "./%s", entry->d_name);

            FILE *fp = fopen(path, "r+");
            if (!fp) {
                printf("Error: could not open file %s\n", path);
                continue;
            }

            char buffer[BUFFER_SIZE];
            int indent_level = 0;

            // Loop through lines in file
            while (fgets(buffer, BUFFER_SIZE, fp) != NULL) {
                char *pos = strstr(buffer, SEARCH_STRING);
                if (pos != NULL) {
                    // Extract table name from string
                    char *table_name_start = pos + strlen(SEARCH_STRING);
                    char *table_name_end = strchr(table_name_start, '\'');
                    if (!table_name_end) {
                        printf("Error: invalid file format in %s\n", path);
                        break;
                    }
                    int table_name_len = table_name_end - table_name_start;
                    char table_name[table_name_len + 1];
                    strncpy(table_name, table_name_start, table_name_len);
                    table_name[table_name_len] = '\0';

                    // Replace pattern with new string
                    char replace_string[BUFFER_SIZE];
                    sprintf(replace_string, REPLACE_STRING, table_name, table_name);
                    strncpy(pos, replace_string, strlen(replace_string));

                    // Count indentation level from beginning of line to position of 'Schema::create('
                    indent_level = pos - buffer;
                } else if (indent_level > 0) {
                    // Add tab spacing to line after replace operation
                    int i;
                    for (i = 0; i < indent_level; i++) {
                        fputc('\t', fp);
                    }
                }

                // Check for first occurrence of '}' character after 'Schema::create('
                if (indent_level > 0 && strchr(buffer, '}') != NULL) {
                    indent_level = 0;
                }

                // Write modified line to file
                fputs(buffer, fp);
            }

            // Truncate file after modified content
            fflush(fp);
            ftruncate(fileno(fp), ftell(fp));
            fclose(fp);
        }
    }

    closedir(dir);
    return 0;
}
