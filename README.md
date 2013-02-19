twitterforfun
=============

A simple Google Maps/Twitter mashup

##File Description:

### index.html
>Googlemap mashup(Use Ajax for updating dynamically)

### twitterstream.php		
>Daemon program for fetching tweets with geo tag from Stream API

### lib/								
>Use Phirehose Liabrary for Twitter Stream.

### result.xml					
>	Store temp tweet for Ajax call.

##How to Run:
1. Put twitterforfun in /var/www
2. Run "php twitterstream.php" as deamon
3. Go "http://localhost/twitterforfun/index.html" for fun

##Demo image
![snapshop](https://raw.github.com/ipmsteven/twitterforfun/master/demo.png)

