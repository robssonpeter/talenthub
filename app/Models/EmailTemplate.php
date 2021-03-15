<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Self_;

class EmailTemplate extends Model
{
    const TYPES_TABLES = [
        'interview_schedule' => [
            'tables' => ['users', 'jobs', 'interviews', 'companies'],
            /*'index' => [
                'interviews' => 'application_id',
                'jobs' => 'id',
                'users' => 'id',
                'companies' => 'user:first_name'
            ],*/
            'sub_relation' => [
                'company_name' => ['table'=>'company:user', 'column' => 'first_name'],
                'interview_date' => ['table'=>'interview', 'column' => 'date'],
                'interview_time' => ['table'=>'interview', 'column' => 'time'],
                'interview_venue' => ['table'=>'interview', 'column' => 'venue'],
            ],
            'app_relation' => [
                'interviews' => 'interview',
                'jobs' => 'job',
                'candidates' => 'candidate',
                'companies' => 'company',
                'users' => 'user'
            ],
            'columns' => ['first_name', 'last_name', 'email', 'phone', 'job_title', 'interview_venue', 'interview_date', 'interview_time', 'company_name']
        ],
        'application_rejection' => [
            'tables' => ['users', 'jobs'],
            'index' => [
                'jobs' => 'id',
                'users' => 'id',
            ],
            'sub_relation' => [
                'company_name' => ['table'=>'company:user', 'column' => 'first_name'],
            ],
            'app_relation' => [
                'jobs' => 'job',
                'users' => 'user',
            ],
            'columns' => ['first_name', 'last_name', 'job_title', 'company_name']
        ],
    ];
    const TYPES = [
      'interview_schedule', 'application_rejection'
    ];
    protected $fillable = [
        'company_id', 'name', 'content', 'type', 'created_by'
    ];

    public static function getColumnTable($type, $column){
        $tables = EmailTemplate::TYPES_TABLES[$type]['tables'];
        foreach($tables as $table){
            if(Schema::hasColumn($table, $column)){
                return $table;
            }
        }
        if(isset(EmailTemplate::TYPES_TABLES[$type]['sub_relation'][$column])){ // if sub-relation exist for the column
            $data = EmailTemplate::TYPES_TABLES[$type]['sub_relation'][$column]; // sub relation information;
            $return = $data['table'].':'.$data['column'];
            return $return;
        }
    }

    public static function placeholders($template_type){
        $columns = EmailTemplate::TYPES_TABLES[$template_type]['columns'];
        for($x = 0; $x < count($columns); $x++){
            $columns[$x] = '['.$columns[$x].']';
        }
        $placeholders = implode(', ', $columns);
        return $placeholders;
    }

    public static function typesAssoc(){
        $types = EmailTemplate::TYPES;
        $typesAssoc = [];
        foreach($types as $type){
            $typesAssoc[$type] = ucwords(str_replace('_', ' ', $type));
        }
        return $typesAssoc;
    }

    public static function renderTemplate($application_id, $template_id){
        $template = EmailTemplate::find($template_id);
        $tables = EmailTemplate::TYPES_TABLES;
        $types = EmailTemplate::TYPES;
        $application = JobApplication::where('id', $application_id);
        $withs = [];
        foreach($tables[$template->type]['tables'] as $table){
            $relation = $tables[$template->type]['app_relation'][$table];
            //array_push($withs, $relation);
            $application = $application->with($relation);
        }
        $application = $application->first();
        $contentTemplate = $template->content;
        $columns = $tables[$template->type]['columns'];

        foreach($columns as $column){
            $columnTable = EmailTemplate::getColumnTable($template->type, $column);
            $placeholder = '['.$column.']';
            if(!strpos($columnTable, ':')){
                $relation = $tables[$template->type]['app_relation'][$columnTable];
                $replacement = $application->$relation->$column;
            }else{
                // replace the . with : for better array creation
                $relation = str_replace('.', ':', $columnTable);
                $relations = explode(':', $relation);
                $replacement = $application;
                // Loop through the relations to make them as attributes
                foreach($relations as $relation){
                    $replacement = $replacement->$relation;
                }
            }
            $contentTemplate = str_replace($placeholder, $replacement, $contentTemplate);
        }
        return $contentTemplate;
    }
}
