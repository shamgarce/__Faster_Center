<?php
MongoDBRef{
	public static array create(string $collection , mixed $id [, string $database ])




	public static array get ( MongoDB $db , array $ref )
	public static bool isRef ( mixed $ref )
}





$people = $db->selectCollection("people");

// model trains are in the "hobbies" collection
$trainRef = MongoDBRef::create("hobbies", $modelTrains['_id']);
// soccer is in the "sports" collection
$soccerRef = MongoDBRef::create("sports", $soccer['_id']);

// now we'll know what collections the items in the "likes" array came from when
// we retrieve this document
//  # 现在当我们读取这个文档的时候，就可以知道“likes”字段里的数组元素分别来自哪个集合了。
$people->insert(array("name" => "Fred", "likes" => array($trainRef, $soccerRef)));

?>