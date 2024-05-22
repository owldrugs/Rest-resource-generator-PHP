# **Rest-resource-generator-PHP**
Simple rest resource generator

**App create**<br>
Api initialize:<br>
`$api = new Api();`
<br>
Add resource(The table in the database must be created with all the fields by you, including the column with the "id"):
<br>
`$api->registerResourse('Users', \app\resourses\Users::class,['get','post','put','delete']);`
<br>
Run app:
<br>
`$api->run();`


**Routing**<br>
If the request handler class is called 'example', then the solution paths will be as follows:
<br>
GET:<br>
url/example - get all<br>
url entries/example/{id} - get an entry by id<br>

POST:<br>
url/example - add an entry<br>
<br>
PUT:<br>
url/example - update the record<br>
<br>
DELETE:<br>
url/example - delete an entry<br>