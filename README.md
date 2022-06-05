### Setup
1. Configure .env file `DATABASE_URL` variable to setup database </br>
2. `Composer install` </br>
3. Make a migration `bin/console doctrine:migrations:migrate` <br>
4. Start local server: `symfony server:start -d` </br>
</br>

### How it works
Using Postman App, make a POST request to `127.0.0.1:8000/api/upload`, with request body as form-data, add key `file[]`, and select file type: file. </br>
</br>

### Notes
1. Add second form-data key: `type` to request, to specify which archiving method to use. Pass the variable to `ZipFilesService`.
2. Don't know for sure, my guess is: make requests asynchronous, or limit requests per client.
3. Change max file size in `zipFiles`. Reduce file sizes while archiving.