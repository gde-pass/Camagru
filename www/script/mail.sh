curl -v \
        --url 'smtps://mail.cock.li:465' \
        --ssl-reqd \
        --mail-from 'camagru@horsefucker.org' \
        --mail-rcpt $1 \
        --upload-file /tmp/mail.txt \
        --user 'camagru@horsefucker.org:Camagru42' \
        --insecure -v
