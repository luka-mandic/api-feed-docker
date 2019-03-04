## Dockerized api

Just a simple dockerized api, to check it out first run:

`docker-compose build`

`docker-compose up -d`

Then you can visit: 

`http://localhost:8080/api/v1/posts`

`http://localhost:8080/api/v1/tags`

to get a list of all the posts and tags,

`http://localhost:8080/api/v1/posts/{id}`

for a single post, and:

`http://localhost:8080/api/v1/posts/{id}/tags`

to get all the tags associated with that post.