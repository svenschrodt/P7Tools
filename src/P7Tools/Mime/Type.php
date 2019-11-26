<?php declare(strict_types=1); declare(strict_types=1);
/**
 * Multipurpose Internet Mail Extensions (MIME) types
 *
 * @see http://tools.ietf.org/html/rfc2045
 * @see http://tools.ietf.org/html/rfc2046
 * @see http://tools.ietf.org/html/rfc2077
 * @see http://www.iana.org/assignments/media-types/media-types.xhtml
 *
 */
namespace P7Tools\Mime;

class Type
{

    const APPLICATION_ACAD = 'application/acad';

    const APPLICATION_APPLEFILE = 'application/applefile';

    const APPLICATION_ASTOUND = 'application/astound';

    const APPLICATION_DSPTYPE = 'application/dsptype';

    const APPLICATION_DXF = 'application/dxf';

    const APPLICATION_FUTURESPLASH = 'application/futuresplash';

    const APPLICATION_GZIP = 'application/gzip';

    const APPLICATION_JSON = 'application/json';

    const APPLICATION_LISTENUP = 'application/listenup';

    const APPLICATION_MAC_BINHEX40 = 'application/mac-binhex40';

    const APPLICATION_MBEDLET = 'application/mbedlet';

    const APPLICATION_MIF = 'application/mif';

    const APPLICATION_MSEXCEL = 'application/msexcel';

    const APPLICATION_MSHELP = 'application/mshelp';

    const APPLICATION_MSPOWERPOINT = 'application/mspowerpoint';

    const APPLICATION_MSWORD = 'application/msword';

    const APPLICATION_OCTET_STREAM = 'application/octet-stream';

    const APPLICATION_ODA = 'application/oda';

    const APPLICATION_PDF = 'application/pdf';

    const APPLICATION_POSTSCRIPT = 'application/postscript';

    const APPLICATION_RTC = 'application/rtc';

    const APPLICATION_RTF = 'application/rtf';

    const APPLICATION_STUDIOM = 'application/studiom';

    const APPLICATION_TOOLBOOK = 'application/toolbook';

    const APPLICATION_VOCALTEC_MEDIA_DESC = 'application/vocaltec-media-desc';

    const APPLICATION_VOCALTEC_MEDIA_FILE = 'application/vocaltec-media-file';

    const APPLICATION_VND_OPENXMLFORMATS_OFFICEDOCUMENT_SPREADSHEETML_SHEET = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';

    const APPLICATION_VND_OPENXMLFORMATS_OFFICEDOCUMENT_WORDPROCESSINGML_DOCUMENT = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';

    const APPLICATION_XHTML_XML = 'application/xhtml+xml';

    const APPLICATION_XML = 'application/xml';

    const APPLICATION_X_BCPIO = 'application/x-bcpio';

    const APPLICATION_X_COMPRESS = 'application/x-compress';

    const APPLICATION_X_CPIO = 'application/x-cpio';

    const APPLICATION_X_CSH = 'application/x-csh';

    const APPLICATION_X_DIRECTOR = 'application/x-director';

    const APPLICATION_X_DVI = 'application/x-dvi';

    const APPLICATION_X_ENVOY = 'application/x-envoy';

    const APPLICATION_X_GTAR = 'application/x-gtar';

    const APPLICATION_X_HDF = 'application/x-hdf';

    const APPLICATION_X_HTTPD_PHP = 'application/x-httpd-php';

    const APPLICATION_X_JAVASCRIPT = 'application/x-javascript';

    const APPLICATION_X_LATEX = 'application/x-latex';

    const APPLICATION_X_MACBINARY = 'application/x-macbinary';

    const APPLICATION_X_MIF = 'application/x-mif';

    const APPLICATION_X_NETCDF = 'application/x-netcdf';

    const APPLICATION_X_NSCHAT = 'application/x-nschat';

    const APPLICATION_X_SH = 'application/x-sh';

    const APPLICATION_X_SHAR = 'application/x-shar';

    const APPLICATION_X_SHOCKWAVE_FLASH = 'application/x-shockwave-flash';

    const APPLICATION_X_SPRITE = 'application/x-sprite';

    const APPLICATION_X_STUFFIT = 'application/x-stuffit';

    const APPLICATION_X_SUPERCARD = 'application/x-supercard';

    const APPLICATION_X_SV4CPIO = 'application/x-sv4cpio';

    const APPLICATION_X_SV4CRC = 'application/x-sv4crc';

    const APPLICATION_X_TAR = 'application/x-tar';

    const APPLICATION_X_TCL = 'application/x-tcl';

    const APPLICATION_X_TEX = 'application/x-tex';

    const APPLICATION_X_TEXINFO = 'application/x-texinfo';

    const APPLICATION_X_TROFF = 'application/x-troff';

    const APPLICATION_X_TROFF_MAN = 'application/x-troff-man';

    const APPLICATION_X_TROFF_ME = 'application/x-troff-me';

    const APPLICATION_X_TROFF_MS = 'application/x-troff-ms';

    const APPLICATION_X_USTAR = 'application/x-ustar';

    const APPLICATION_X_WAIS_SOURCE = 'application/x-wais-source';

    const APPLICATION_X_WWW_FORM_URLENCODED = 'application/x-www-form-urlencoded';

    const APPLICATION_ZIP = 'application/zip';

    const AUDIO_BASIC = 'audio/basic';

    const AUDIO_ECHOSPEECH = 'audio/echospeech';

    const AUDIO_TSPLAYER = 'audio/tsplayer';

    const AUDIO_VOXWARE = 'audio/voxware';

    const AUDIO_X_AIFF = 'audio/x-aiff';

    const AUDIO_X_DSPEEH = 'audio/x-dspeeh';

    const AUDIO_X_MIDI = 'audio/x-midi';

    const AUDIO_X_MPEG = 'audio/x-mpeg';

    const AUDIO_X_PN_REALAUDIO = 'audio/x-pn-realaudio';

    const AUDIO_X_PN_REALAUDIO_PLUGIN = 'audio/x-pn-realaudio-plugin';

    const AUDIO_X_QT_STREAM = 'audio/x-qt-stream';

    const AUDIO_X_WAV = 'audio/x-wav';

    const DRAWING_X_DWF = 'drawing/x-dwf';

    const IMAGE_CIS_COD = 'image/cis-cod';

    const IMAGE_CMU_RASTER = 'image/cmu-raster';

    const IMAGE_FIF = 'image/fif';

    const IMAGE_GIF = 'image/gif';

    const IMAGE_IEF = 'image/ief';

    const IMAGE_JPEG = 'image/jpeg';

    const IMAGE_PNG = 'image/png';

    const IMAGE_TIFF = 'image/tiff';

    const IMAGE_VASA = 'image/vasa';

    const IMAGE_VND_WAP_WBMP = 'image/vnd.wap.wbmp';

    const IMAGE_X_FREEHAND = 'image/x-freehand';

    const IMAGE_X_ICON = 'image/x-icon';

    const IMAGE_X_PORTABLE_ANYMAP = 'image/x-portable-anymap';

    const IMAGE_X_PORTABLE_BITMAP = 'image/x-portable-bitmap';

    const IMAGE_X_PORTABLE_GRAYMAP = 'image/x-portable-graymap';

    const IMAGE_X_PORTABLE_PIXMAP = 'image/x-portable-pixmap';

    const IMAGE_X_RGB = 'image/x-rgb';

    const IMAGE_X_WINDOWDUMP = 'image/x-windowdump';

    const IMAGE_X_XBITMAP = 'image/x-xbitmap';

    const IMAGE_X_XPIXMAP = 'image/x-xpixmap';

    const MESSAGE_EXTERNAL_BODY = 'message/external-body';

    const MESSAGE_HTTP = 'message/http';

    const MESSAGE_NEWS = 'message/news';

    const MESSAGE_PARTIAL = 'message/partial';

    const MESSAGE_RFC822 = 'message/rfc822';

    const MODEL_VRML = 'model/vrml';

    const MULTIPART_ALTERNATIVE = 'multipart/alternative';

    const MULTIPART_BYTERANGES = 'multipart/byteranges';

    const MULTIPART_DIGEST = 'multipart/digest';

    const MULTIPART_ENCRYPTED = 'multipart/encrypted';

    const MULTIPART_FORM_DATA = 'multipart/form-data';

    const MULTIPART_MIXED = 'multipart/mixed';

    const MULTIPART_PARALLEL = 'multipart/parallel';

    const MULTIPART_RELATED = 'multipart/related';

    const MULTIPART_REPORT = 'multipart/report';

    const MULTIPART_SIGNED = 'multipart/signed';

    const MULTIPART_VOICE_MESSAGE = 'multipart/voice-message';

    const TEXT_COMMA_SEPARATED_VALUES = 'text/comma-separated-values';

    const TEXT_CSS = 'text/css';

    const TEXT_HTML = 'text/html';

    const TEXT_JAVASCRIPT = 'text/javascript';

    const TEXT_PLAIN = 'text/plain';

    const TEXT_RICHTEXT = 'text/richtext';

    const TEXT_RTF = 'text/rtf';

    const TEXT_TAB_SEPARATED_VALUES = 'text/tab-separated-values';

    const TEXT_VND_WAP_WML = 'text/vnd.wap.wml';

    const APPLICATION_VND_WAP_WMLC = 'application/vnd.wap.wmlc';

    const TEXT_VND_WAP_WMLSCRIPT = 'text/vnd.wap.wmlscript';

    const APPLICATION_VND_WAP_WMLSCRIPTC = 'application/vnd.wap.wmlscriptc';

    const TEXT_XML = 'text/xml';

    const TEXT_XML_EXTERNAL_PARSED_ENTITY = 'text/xml-external-parsed-entity';

    const TEXT_X_SETEXT = 'text/x-setext';

    const TEXT_X_SGML = 'text/x-sgml';

    const TEXT_X_SPEECH = 'text/x-speech';

    const VIDEO_MPEG = 'video/mpeg';

    const VIDEO_QUICKTIME = 'video/quicktime';

    const VIDEO_VND_VIVO = 'video/vnd.vivo';

    const VIDEO_X_MSVIDEO = 'video/x-msvideo';

    const VIDEO_X_SGI_MOVIE = 'video/x-sgi-movie';

    const WORKBOOK_FORMULAONE = 'workbook/formulaone';

    const X_WORLD_X_3DMF = 'x-world/x-3dmf';

    const X_WORLD_X_VRML = 'x-world/x-vrml';
}