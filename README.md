## Setup

<p> Requirements </p>
<pre>
    1) php 7.4
    2) composer https://getcomposer.org/ 
    3) mysql 8.0
</pre>
<p>
    Installation Steps After Cloning:
<br>
<ul>
        <li>composer update </li>
        <li>cp .env.example .env </li>
        <li>php artisan key:generate</li>
        <li>Edit following credentials in .env for mysql setup: 
            <br/>
            <pre>
                DB_HOST=
                DB_PORT=3306
                DB_DATABASE=
                DB_USERNAME=
                DB_PASSWORD=
            </pre>
        </li>
        <li>php artisan migrate</li>
        <li>Run command "php artisan db:seed"</li>
        <li>Permission to access Files
            <pre>
            sudo chmod -R 775 /var/www/*project_foler*
            sudo chown -R www-data:www-data var/www/*project_foler*
            </pre>
        </li>
        <li>php artisan optimize:clear</li>
        </ul>
</P>
<hr>
<p> On new commit 
<br>

<ul>
    <li>composer install</li>
    <li>composer dump-autoload</li>
    <li>php artisan migrate</li>
    <li>php artisan optimize:clear</li>
</ul>

</p>
</p>
<pre>
    Env for production:

    APP_ENV=production      
    APP_DEBUG=false     #set to true to check any errors
    REDIRECT_HTTPS=true     #if ssl enabled
    APP_URL=https://nrna.ybcsystems.com     #homepage url
</pre>
