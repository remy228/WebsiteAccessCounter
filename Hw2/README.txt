
The Hw2.zip consists of 3 folders -

1.)Analytics - i)index.php 

2.)web-site - i)Model - readfile.php and readfilehtml.php (Reading files from our data store counts.txt)
             ii)View  - All html,jpg files.
            iii)index.php - Contains the logic which works on model and renders the desired view.

            
3.)data - /counts.txt is our database where in we are dumping all the logs in space separated format (web-site timestamp ipaddress)


Note: 
when opening an html file through index.php,i.e localhost/HW2/web-site/index.php/1.html), it first renders the html file and then it refreshes within 5 seconds to show the actual file. The same is the case
for jpg files too.
Initially, the counts.txt will have values that show how many times we visited the pages/images.
