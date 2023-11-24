# Insecure-WebApp-For-Security-Training
# **Description**

<aside>
📌 This is a simple web application written by me for the purpose of getting to know some web app vulnerabilities based on **OWASP** and learning how to fix them.
Looking into this Project is good for web developers and pentesters or anyone who is an security enthusiastic.

</aside>

## Vulnerabilities:

There are many vulnerabilities that can be found in this project some of which are described below but there are definitely more, so search for them ;)
And be aware that some security notes are available in the source codes as comment.

### Security Missconfig

> Using force browsing you can find some files like .git, .sql or other hidden php files like db.php
> 

> **/admin/** path access denied can be bypassed using **X-forwarded-for** HTTP header set to 127.0.0.1
> 

> Any system file like /etc/passwd can be read by setting **imgsrc** parameter in query string of get_image.php to the file path or by using directory traversal like: ?? **imgsrc=/../../../../anything_from_root_on**
> 

### SQL injection

> The **post_id, author_id** parameters in the URL query string of **show_posts.php and all_posts.php** which can be exploited using this query: **post_id=3.333 union select 1,user(),database(),4,5,6** 
and so on ….
> 

> There is also the simplest SQLi in the login.php page exploited by : **random’ or 1=1#**
> 

### SSRF

> The same **imgsrc** parameter from SecMissconfig part can be used to send requests because you can change the scheme from default one which is [file://](file://) to http; for example: **[http://127.0.0.1/admin/](http://localhost/admin/)** which ****can bypass the admin page restriction ****
>
