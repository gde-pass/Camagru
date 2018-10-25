WHY I CAN'T USE API's ?

If you want to use some APIs like Google or Facebook, they may want you to have domain name.
So if you want to use those APIs and stay on a localhost dev config,
you just have to edit the port forwarding menu of your docker-machine directly in VirtualBox.

WHY I DON'T RECEIVE ANY MAIL FROM MY APPLICATION ?

During the dev part of your project you should use MAILHOG (It's activated by default).
MailHog is an email testing tool.
So if you want to send email with GMAIL you have to configure the SMTP GMAIL RELAY in the apache Dockerfile,
and comment the MAILHOG part in the Dockerfile and Docker-Compose file. 
