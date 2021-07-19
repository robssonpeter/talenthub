<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    //
    const STATUS_NOT_VIEWED = null;
    const STATUS_VIEWED = 1;
    const STATUS_DISMISSED = 2;

    protected $fillable = [
        'user_id', 'title', 'message', 'dismissible', 'type', 'link', 'link_text', 'status'
    ];

    protected $appends = ['action'];

    public function getActionAttribute(){
        return [
            'name' => $this->link_text,
            'url' => self::decodeLink($this->link),
        ];
    }

    public static function encodeLink($route_name, array $parameters = [], $hash = ''){
        $data = [
            'route' => $route_name,
            'parameters' => $parameters,
            'hash' => $hash
        ];
        return json_encode($data);
    }

    public static function decodeLink($data){
        $data = json_decode($data);
        $link = route($data->route, (array) $data->parameters).$data->hash;
        return $link;
    }
}
