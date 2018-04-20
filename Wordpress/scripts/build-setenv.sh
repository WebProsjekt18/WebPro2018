#!/bin/sh
LDFLAGS="-L/Users/tomfevang/WebPro2018/Wordpress/common/lib $LDFLAGS"
export LDFLAGS
CFLAGS="-I/Users/tomfevang/WebPro2018/Wordpress/common/include/ImageMagick -I/Users/tomfevang/WebPro2018/Wordpress/common/include $CFLAGS"
export CFLAGS
CXXFLAGS="-I/Users/tomfevang/WebPro2018/Wordpress/common/include $CXXFLAGS"
export CXXFLAGS
		    
PKG_CONFIG_PATH="/Users/tomfevang/WebPro2018/Wordpress/common/lib/pkgconfig"
export PKG_CONFIG_PATH
