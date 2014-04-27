<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once './vendor/autoload.php';
use Livefyre\Livefyre;

if (!function_exists('lf_get_collection_metadata'))
{
    function lf_get_collection_metadata($params)
    {
        $collectionMeta = array(
        	"title" => $params[ARTICLE_TITLE],
        	"url"	=> base_url().$params[ARTICLE_URL]
        );

        // Optional Params
       	$collectionMeta["tags"] = ( array_key_exists(ARTICLE_TAGS,$params) ) ? $params[ARTICLE_TAGS] : '';
        $collectionMeta["type"] = ( array_key_exists(COLLECTION_TYPE,$params) )  ? $params[COLLECTION_TYPE] : 'livecomments';
		
		
		
        if (LIVEFYRE_LIBRARY) {
            $checksum = $site->buildChecksum($collectionMeta['title'], $collectionMeta['url'], $collectionMeta['tags'], $collectionMeta['type']); 
            $collectionMetaToken = $site->buildCollectionMetaToken($collectionMeta['title'],$params[ARTICLE_ID],$collectionMeta['url'],$collectionMeta['tags']);
            return array(
                'checksum' => $checksum,
                'collectionMeta' => $collectionMetaToken
            );
        } else {
            $checksum = md5(json_encode($collectionMeta));
        
            $collectionMeta['checksum'] = $checksum;
            $collectionMeta['articleId'] = $params[ARTICLE_ID];
            return array(
                'checksum'=> $checksum,
                'collectionMeta' => JWT::encode($collectionMeta, LIVEFYRE_SITE_KEY)
            );
        }
    }
}
