# **Rest-resource-generator-PHP**
Simple rest resource generator

**App create**<br>
Api initialize:<br>
`$api = new Api();`
<br>
Add resource:
<br>
`$api->registerResourse('Users', \app\resourses\Users::class,['get','post','put','delete']);`
<br>
Run app:
<br>
`$api->run();`
