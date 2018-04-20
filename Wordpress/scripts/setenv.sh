#!/bin/sh
echo $PATH | egrep "/Users/tomfevang/WebPro2018/Wordpress/common" > /dev/null
if [ $? -ne 0 ] ; then
PATH="/Users/tomfevang/WebPro2018/Wordpress/apps/wordpress/bin:/Users/tomfevang/WebPro2018/Wordpress/varnish/bin:/Users/tomfevang/WebPro2018/Wordpress/sqlite/bin:/Users/tomfevang/WebPro2018/Wordpress/php/bin:/Users/tomfevang/WebPro2018/Wordpress/mysql/bin:/Users/tomfevang/WebPro2018/Wordpress/apache2/bin:/Users/tomfevang/WebPro2018/Wordpress/common/bin:$PATH"
export PATH
fi
echo $DYLD_FALLBACK_LIBRARY_PATH | egrep "/Users/tomfevang/WebPro2018/Wordpress/common" > /dev/null
if [ $? -ne 0 ] ; then
DYLD_FALLBACK_LIBRARY_PATH="/Users/tomfevang/WebPro2018/Wordpress/varnish/lib:/Users/tomfevang/WebPro2018/Wordpress/varnish/lib/varnish:/Users/tomfevang/WebPro2018/Wordpress/varnish/lib/varnish/vmods:/Users/tomfevang/WebPro2018/Wordpress/sqlite/lib:/Users/tomfevang/WebPro2018/Wordpress/mysql/lib:/Users/tomfevang/WebPro2018/Wordpress/apache2/lib:/Users/tomfevang/WebPro2018/Wordpress/common/lib:/usr/local/lib:/lib:/usr/lib:$DYLD_FALLBACK_LIBRARY_PATH"
export DYLD_FALLBACK_LIBRARY_PATH
fi

TERMINFO=/Users/tomfevang/WebPro2018/Wordpress/common/share/terminfo
export TERMINFO
##### VARNISH ENV #####
		
      ##### SQLITE ENV #####
			
SASL_CONF_PATH=/Users/tomfevang/WebPro2018/Wordpress/common/etc
export SASL_CONF_PATH
SASL_PATH=/Users/tomfevang/WebPro2018/Wordpress/common/lib/sasl2 
export SASL_PATH
LDAPCONF=/Users/tomfevang/WebPro2018/Wordpress/common/etc/openldap/ldap.conf
export LDAPCONF
##### IMAGEMAGICK ENV #####
MAGICK_HOME="/Users/tomfevang/WebPro2018/Wordpress/common"
export MAGICK_HOME

MAGICK_CONFIGURE_PATH="/Users/tomfevang/WebPro2018/Wordpress/common/lib/ImageMagick-6.9.8/config-Q16:/Users/tomfevang/WebPro2018/Wordpress/common/"
export MAGICK_CONFIGURE_PATH

MAGICK_CODER_MODULE_PATH="/Users/tomfevang/WebPro2018/Wordpress/common/lib/ImageMagick-6.9.8/modules-Q16/coders"
export MAGICK_CODER_MODULE_PATH

##### FONTCONFIG ENV #####
FONTCONFIG_PATH="/Users/tomfevang/WebPro2018/Wordpress/common/etc/fonts"
export FONTCONFIG_PATH
##### PHP ENV #####
PHP_PATH=/Users/tomfevang/WebPro2018/Wordpress/php/bin/php
COMPOSER_HOME=/Users/tomfevang/WebPro2018/Wordpress/php/composer
export PHP_PATH
export COMPOSER_HOME
##### MYSQL ENV #####

##### APACHE ENV #####

##### CURL ENV #####
CURL_CA_BUNDLE=/Users/tomfevang/WebPro2018/Wordpress/common/openssl/certs/curl-ca-bundle.crt
export CURL_CA_BUNDLE
##### SSL ENV #####
SSL_CERT_FILE=/Users/tomfevang/WebPro2018/Wordpress/common/openssl/certs/curl-ca-bundle.crt
export SSL_CERT_FILE
OPENSSL_CONF=/Users/tomfevang/WebPro2018/Wordpress/common/openssl/openssl.cnf
export OPENSSL_CONF
OPENSSL_ENGINES=/Users/tomfevang/WebPro2018/Wordpress/common/lib/engines
export OPENSSL_ENGINES


. /Users/tomfevang/WebPro2018/Wordpress/scripts/build-setenv.sh
