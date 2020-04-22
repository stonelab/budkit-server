<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * requirements.inc
 *
 * Requires PHP version 5.3
 *
 * LICENSE: This source file is subject to version 3.01 of the GNU/GPL License
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/gpl.txt  If you did not receive a copy of
 * the GPL License and are unable to obtain it through the web, please
 * send a note to support@stonyhillshq.com so we can mail you a copy immediately.
 *
 * @category   Utility
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version    Release: 1.0.0
 *
 */
return array(
    "modules" => array(
        "gd" => array(
            "title" => t('Image Manipultation'),
            "installed" => true,
            "loaded" => true
        ),
        "mcrypt" => array(
            "title" => t('Cryptography Handling'),
            "installed" => true,
            "loaded" => true
        ),
        "gettext" => array(
            "title" => t('Localization'),
            "installed" => true,
            "loaded" => true
        ),
        "tokenizer" => array(
            "title" => t('Tokenizer'),
            "installed" => true,
            "loaded" => true
        ),
        "pcre" => array(
            "title" => t('Perl Compatible RegEx'),
            "installed" => true,
            "loaded" => true
        ),
        "json" => array(
            "title" => t('javaScript Object Notation'),
            "installed" => true,
            "loaded" => true
        ),
        "iconv" => array(
            "title" => t('IconV Character-Set Conversion'),
            "installed" => true,
            "loaded" => true
        ),
        "imap" => array(
            "title" => t('IMAP extension'),
            "installed" => true,
            "loaded" => true
        ),
        "sockets" => array(
            "title" => t('PHP Sockets'),
            "installed" => true,
            "loaded" => true
        ),
        "mbstring" => array(
            "title" => t('Multibyte Strings'),
            "installed" => true,
            "loaded" => true
        ),
        "ctype" => array(
            "title" => t('Character-Type checking'),
            "installed" => true,
            "loaded" => true
        ),
        "curl" => array(
            "title" => t('cURL'),
            "installed" => true,
            "loaded" => true
        ),
        "libxml" => array(
            "title" => t('XML Manipulation'),
            "installed" => true,
            "loaded" => true
        ),
        "zlib" => array(
            "title" => t('Zlib Compression'),
            "installed" => true,
            "loaded" => true
        ),
        "mysqli" => array(
            "title" => t('MySQLi'),
            "installed" => true,
            "loaded" => true,
            "alternate" => array(
                "postgresql" => array(
                    "installed" => true,
                    "loaded" => true,
                    "title" => t('PostgreSQL'),
                    "alternate" => array(
                        "sqlite3" => array(
                            "title" => t('sQLite3'),
                            "installed" => true,
                            "loaded" => true,
                        //"terminal"  => true || If we get to this stage, then the error is terminal
                        )
                    )
                )
            )
        ),
    ),
    "directives" => array(
        "safe_mode" => array(
            "status" => false,
            "terminal" => true,
        ),
        "display_errors" => array(
            "status" => false,
            "terminal" => false,
        ),
        "magic_quotes_sybase" => array(
            "status" => false,
            "terminal" => true,
        ),
        "magic_quotes_gpc" => array(
            "status" => false,
            "terminal" => true,
        ),
        "magic_quotes_runtime" => array(
            "status" => false,
            "terminal" => true,
        ),
        "session.auto_start" => array(
            "status" => false,
            "terminal" => false,
        ),
        "output_buffering" => array(
            "status" => true,
            "terminal" => false,
        ),
        "register_globals" => array(
            "status" => false,
            "terminal" => true,
        ),
        "file_uploads" => array(
            "status" => true,
            "terminal" => true,
        )
    ),
    "limits" => array(
        "upload_max_filesize" => array(
            "status" => "200M",
            "compare" => "greater",
            "type" => "bytesize",
            "terminal" => true,
        )
    ),
    "server" => array(
        "PHP Version" => array(
            "version" => "7.0.0",
            "minimal" => ">=",
            "terminal" => true,
            "current" => PHP_VERSION
        )
    ),
    "directories" => array(
        "config" => array(
            "title" => "Configuration folder",
            "writable" => true,
            "path" => PATH_CONFIG,
            "terminal" => true,
        ),
        "session" => array(
            "title" => "Sessions folder",
            "writable" => true,
            "path" => PATH_DATA . DS . 'sessions',
            "terminal" => true,
        ),
        "users" => array(
            "title" => "Users folder",
            "writable" => true,
            "path" => PATH_DATA  . DS . "users",
            "terminal" => true,
        ),
        "public" => array(
            "title" => "Public folder",
            "writable" => true,
            "path" => PATH_PUBLIC,
            "terminal" => true,
        ),
        "downloads  " => array(
            "title" => "Downloads folder",
            "writable" => true,
            "path" => PATH_DATA . DS . "downloads",
            "terminal" => true,
        )
    )
);
