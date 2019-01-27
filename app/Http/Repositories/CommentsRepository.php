<?php
/**
 * Created by PhpStorm.
 * User: Nathan
 * Date: 26/01/2019
 * Time: 17:18
 */

namespace App\Http\Repositories;


class CommentsRepository
{
    public static function ban($id_comment, $ban)
    {
        $client = ApiRepository::getClient();
        try
        {
            $url = "comments/" . $id_comment;
            if ($ban)
            {
                $res = json_decode((($client->request('PUT', $url, [
                    "json" => [
                        "values" => [
                            "id_state" => 2
                        ]
                    ]
                ]))->getBody()), true);
            }
            else
            {
                $res = json_decode((($client->request('PUT', $url, [
                    "json" => [
                        "values" => [
                            "id_state" => 3
                        ]
                    ]
                ]))->getBody()), true);
            }

            if (!isset($res["error"]))
            {
                return false;
            }
            else
            {
                return $res["error"];
            }
        }catch (ConnectException | ClientException $e)
        {
            return true;
        }
    }
}
