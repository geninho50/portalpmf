    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (!JitsiMeetJS.app) {
                return;
            }

            JitsiMeetJS.app.renderEntryPoint({
                Component: JitsiMeetJS.app.entryPoints.APP
            })
        })
    </script>
    <script>
        // IE11 and earlier can be identified via their user agent and be
        // redirected to a page that is known to have no newer js syntax.
        if (window.navigator.userAgent.match(/(MSIE|Trident)/)) {
            var roomName = encodeURIComponent(window.location.pathname);
            window.location.href = "static/recommendedBrowsers.html" + "?room=" + roomName;
        }

        window.indexLoadedTime = window.performance.now();
        console.log("(TIME) index.html loaded:\t", indexLoadedTime);
        // XXX the code below listeners for errors and displays an error message
        // in the document body when any of the required files fails to load.
        // The intention is to prevent from displaying broken page.
        var criticalFiles = [
            "config.js",
            "utils.js",
            "do_external_connect.js",
            "interface_config.js",
            "logging_config.js",
            "lib-jitsi-meet.min.js",
            "app.bundle.min.js",
            "all.css?v=4370.993"
        ];
        var loadErrHandler = function(e) {
            var target = e.target;
            // Error on <script> and <link>(CSS)
            // <script> will have .src and <link> .href
            var fileRef = (target.src ? target.src : target.href);
            if (("SCRIPT" === target.tagName || "LINK" === target.tagName)
                && criticalFiles.some(
                    function(file) { return fileRef.indexOf(file) !== -1 })) {
                window.onload = function() {
                    // The whole complex part below implements page reloads with
                    // "exponential backoff". The retry attempt is passes as
                    // "rCounter" query parameter
                    var href = window.location.href;

                    var retryMatch = href.match(/.+(\?|&)rCounter=(\d+)/);
                    var retryCountStr = retryMatch ? retryMatch[2] : "0";
                    var retryCount = Number.parseInt(retryCountStr);

                    if (retryMatch == null) {
                        var separator = href.indexOf("?") === -1 ? "?" : "&";
                        var hashIdx = href.indexOf("#");

                        if (hashIdx === -1) {
                            href += separator + "rCounter=1";
                        } else {
                            var hashPart = href.substr(hashIdx);

                            href = href.substr(0, hashIdx)
                                + separator + "rCounter=1" + hashPart;
                        }
                    } else {
                        var separator = retryMatch[1];

                        href = href.replace(
                            /(\?|&)rCounter=(\d+)/,
                            separator + "rCounter=" + (retryCount + 1));
                    }

                    var delay = Math.pow(2, retryCount) * 2000;
                    if (isNaN(delay) || delay < 2000 || delay > 60000)
                        delay = 10000;

                    var showMoreText = "show more";
                    var showLessText = "show less";

                    document.body.innerHTML
                        = "<div style='"
                        + "position: absolute;top: 50%;left: 50%;"
                        + "text-align: center;"
                        + "font-size: medium;"
                        + "font-weight: 400;"
                        + "transform: translate(-50%, -50%)'>"
                        + "Uh oh! We couldn't fully download everything we needed :("
                        + "<br/> "
                        + "We will try again shortly. In the mean time, check for problems with your Internet connection!"
                        + "<br/><br/> "
                        + "<div id='moreInfo' style='"
                        + "display: none;'>" + "Missing " + fileRef
                        + "<br/><br/></div>"
                        + "<a id='showMore' style='"
                        + "text-decoration: underline;"
                        + "font-size:small;"
                        + "cursor: pointer'>" + showMoreText + "</a>"
                        + "&nbsp;&nbsp;&nbsp;"
                        + "<a id ='reloadLink' style='"
                        + "text-decoration: underline;"
                        + "font-size:small;"
                        + "'>reload now</a>"
                        + "</div>";

                    var reloadLink = document.getElementById('reloadLink');
                    reloadLink.setAttribute('href', href);

                    var showMoreElem = document.getElementById("showMore");
                    showMoreElem.addEventListener('click', function () {
                            var moreInfoElem
                                    = document.getElementById("moreInfo");

                            if (showMoreElem.innerHTML === showMoreText) {
                                moreInfoElem.setAttribute(
                                    "style",
                                    "display: block;"
                                    + "color:#FF991F;"
                                    + "font-size:small;"
                                    + "user-select:text;");
                                showMoreElem.innerHTML = showLessText;
                            }
                            else {
                                moreInfoElem.setAttribute(
                                    "style", "display: none;");
                                showMoreElem.innerHTML = showMoreText;
                            }
                        });

                    window.setTimeout(
                        function () { window.location.replace(href); }, delay);

                    // Call extra handler if defined.
                    if (typeof postLoadErrorHandler === "function") {
                        postLoadErrorHandler(fileRef);
                    }
                };
                window.removeEventListener(
                    'error', loadErrHandler, true /* capture phase */);
            }
        };
        window.addEventListener(
            'error', loadErrHandler, true /* capture phase type of listener */);
    </script>
	
    <script>
	var subdomain = "";
if (subdomain) {
    subdomain = subdomain.substr(0,subdomain.length-1).split('.').join('_').toLowerCase() + '.';
}
var config = {
    hosts: {
        domain: 'meet.jit.si',

        muc: 'conference.'+subdomain+'meet.jit.si', // FIXME: use XEP-0030
        focus: 'focus.meet.jit.si',
    },
    disableSimulcast: false,
    enableRemb: true,
    enableTcc: true,
    resolution: 720,
    constraints: {
        video: {
            height: {
                ideal: 720,
                max: 720,
                min: 180
            },
            width: {
                ideal: 1280,
                max: 1280,
                min: 320
            }
        }
    },
    enableInsecureRoomNameWarning: true,
    externalConnectUrl: '//meet.jit.si/http-pre-bind',
analytics: {
            amplitudeAPPKey: "fafdba4c3b47fe5f151060ca37f02d2f",
                        whiteListedEvents: [ 'conference.joined', 'page.reload.scheduled', 'rejoined', 'transport.stats' ],
    },
    enableP2P: true, // flag to control P2P connections
    // New P2P options
    p2p: {
        enabled: true,
        preferH264: true,
        disableH264: true,
        useStunTurn: true // use XEP-0215 to fetch STUN and TURN servers for the P2P connection
    },
    useStunTurn: true, // use XEP-0215 to fetch TURN servers for the JVB connection
    useTurnUdp: false,
    bosh: '//meet.jit.si/http-bind', // FIXME: use xep-0156 for that
    websocket: 'wss://meet.jit.si/xmpp-websocket', // FIXME: use xep-0156 for that


    clientNode: 'http://jitsi.org/jitsimeet', // The name of client node advertised in XEP-0115 'c' stanza
    //deprecated desktop sharing settings, included only because older version of jitsi-meet require them
    desktopSharing: 'ext', // Desktop sharing method. Can be set to 'ext', 'webrtc' or false to disable.
    chromeExtensionId: 'kglhbbefdnlheedjiejgomgmfplipfeb', // Id of desktop streamer Chrome extension
    desktopSharingSources: ['screen', 'window'],
    googleApiApplicationClientID: "39065779381-bbhnkrgibtf4p0j9ne5vsq7bm49t1tlf.apps.googleusercontent.com",
    microsoftApiApplicationClientID: "00000000-0000-0000-0000-000040240063",
    enableCalendarIntegration: true,
    //new desktop sharing settings
    desktopSharingChromeExtId: 'kglhbbefdnlheedjiejgomgmfplipfeb', // Id of desktop streamer Chrome extension
    desktopSharingChromeSources: ['screen', 'window', 'tab'],
    useRoomAsSharedDocumentName: false,
    enableLipSync: false,
    disableRtx: false, // Enables RTX everywhere
    enableScreenshotCapture: false,
    openBridgeChannel: 'websocket', // One of true, 'datachannel', or 'websocket'
    channelLastN: 20, // The default value of the channel attribute last-n.
    lastNLimits: {
        5: 20,
        30: 15,
        50: 10,
        70: 5,
        90: 2
    },
 // Video Quality settings to limit bitrate
    videoQuality: {
        maxBitratesVideo: {
            low: 200000,
            standard: 500000,
            high: 1500000
        }
    },
    startBitrate: "800",
    disableAudioLevels: false,
    disableSuspendVideo: true,
    stereo: false,
    forceJVB121Ratio:  -1,
    enableTalkWhileMuted: true,

    enableNoAudioDetection: true,

    enableNoisyMicDetection: true,

    enableClosePage: true,

    disableLocalVideoFlip: false,

    hiddenDomain: 'recorder.meet.jit.si',
    dropbox: {
        appKey: '3v5iyto7n7az02w'
    },


    transcribingEnabled: false,
    enableRecording: true,
    liveStreamingEnabled: true,
    fileRecordingsEnabled: true,
    fileRecordingsServiceEnabled: false,
    fileRecordingsServiceSharingEnabled: false,
    requireDisplayName: false,
    enableWelcomePage: true,
    isBrand: false,
    dialInNumbersUrl: 'https://api.jitsi.net/phoneNumberList',
    dialInConfCodeUrl:  'https://api.jitsi.net/conferenceMapper',

    dialOutCodesUrl:  'https://api.jitsi.net/countrycodes',
    dialOutAuthUrl: 'https://api.jitsi.net/authorizephone',
    peopleSearchUrl: 'https://api.jitsi.net/directorySearch',
    inviteServiceUrl: 'https://api.jitsi.net/conferenceInvite',
    inviteServiceCallFlowsUrl: 'https://api.jitsi.net/conferenceinvitecallflows',
    peopleSearchQueryTypes: ['user','conferenceRooms'],
    startAudioMuted: 9,
    startVideoMuted: 9,
    enableUserRolesBasedOnToken: false,
    enableLayerSuspension: true,
    deploymentUrls: {
        userDocumentationURL: "https://jitsi.github.io/handbook/help",
    },
    chromeExtensionBanner: {
        url: "https://chrome.google.com/webstore/detail/jitsi-meetings/kglhbbefdnlheedjiejgomgmfplipfeb",
        chromeExtensionsInfo: [{"path": "jitsi-logo-48x48.png", "id": "kglhbbefdnlheedjiejgomgmfplipfeb"}]
    },
    prejoinPageEnabled: true,
    enableInsecureRoomNameWarning: true,
    hepopAnalyticsUrl: "",
    hepopAnalyticsEvent: {
        product: "lib-jitsi-meet",
        subproduct: "meet-jit-si",
        name: "jitsi.page.load.failed",
        action: "page.load.failed",
        actionSubject: "page.load",
        type: "page.load.failed",
        source: "page.load",
        attributes: {
            type: "operational",
            source: 'page.load'
        },
        server: "meet.jit.si"
    },
    deploymentInfo: {
        environment: 'meet-jit-si',
        envType: 'prod',
        releaseNumber: '857',
        shard: 'meet-jit-si-sa-east-1c-s19',
        region: 'sa-east-1',
        userRegion: 'sa-east-1',
        crossRegion: (!'sa-east-1' || 'sa-east-1' === 'sa-east-1') ? 0 : 1
    },
    e2eping: {
        pingInterval: -1
    },
    abTesting: {
    },
    testing: {
        capScreenshareBitrate: 1,
        octo: {
            probability: 1
        }
    }
};
</script>

<!-- adapt to your needs, i.e. set hosts and bosh path -->
   
   <script src="libs/external_connect.js?v=1"></script>

    <script src="libs/do_external_connect.min.js?v=1"></script>
    <script>
	/* eslint-disable no-unused-vars, no-var, max-len */
/* eslint sort-keys: ["error", "asc", {"caseSensitive": false}] */

var interfaceConfig = {
    APP_NAME: 'Jitsi Meet',
    AUDIO_LEVEL_PRIMARY_COLOR: 'rgba(255,255,255,0.4)',
    AUDIO_LEVEL_SECONDARY_COLOR: 'rgba(255,255,255,0.2)',

    /**
     * A UX mode where the last screen share participant is automatically
     * pinned. Valid values are the string "remote-only" so remote participants
     * get pinned but not local, otherwise any truthy value for all participants,
     * and any falsy value to disable the feature.
     *
     * Note: this mode is experimental and subject to breakage.
     */
    AUTO_PIN_LATEST_SCREEN_SHARE: 'remote-only',
    BRAND_WATERMARK_LINK: '',

    // A html text to be shown to guests on the close page, false disables it
    CLOSE_PAGE_GUEST_HINT: '<div class = "hint-msg">For a complete meeting history <a href = "https://app.8x8.vc/?register=true" rel = "noopener" target = "_blank">sign up now</a> <br> for 8x8 Meet.',
    /**
     * Whether the connection indicator icon should hide itself based on
     * connection strength. If true, the connection indicator will remain
     * displayed while the participant has a weak connection and will hide
     * itself after the CONNECTION_INDICATOR_HIDE_TIMEOUT when the connection is
     * strong.
     *
     * @type {boolean}
     */
    CONNECTION_INDICATOR_AUTO_HIDE_ENABLED: true,

    /**
     * How long the connection indicator should remain displayed before hiding.
     * Used in conjunction with CONNECTION_INDICATOR_AUTOHIDE_ENABLED.
     *
     * @type {number}
     */
    CONNECTION_INDICATOR_AUTO_HIDE_TIMEOUT: 5000,

    /**
     * If true, hides the connection indicators completely.
     *
     * @type {boolean}
     */
    CONNECTION_INDICATOR_DISABLED: false,

    DEFAULT_BACKGROUND: '#474747',
    DEFAULT_LOCAL_DISPLAY_NAME: 'me',
    DEFAULT_LOGO_URL: 'images/watermark.png',
    DEFAULT_REMOTE_DISPLAY_NAME: 'Fellow Jitster',
    DEFAULT_WELCOME_PAGE_LOGO_URL: 'images/watermark.png',

    DISABLE_DOMINANT_SPEAKER_INDICATOR: false,

    DISABLE_FOCUS_INDICATOR: true,

    /**
     * If true, notifications regarding joining/leaving are no longer displayed.
     */
    DISABLE_JOIN_LEAVE_NOTIFICATIONS: true,

    /**
     * If true, presence status: busy, calling, connected etc. is not displayed.
     */
    DISABLE_PRESENCE_STATUS: true,

    /**
     * Whether the ringing sound in the call/ring overlay is disabled. If
     * {@code undefined}, defaults to {@code false}.
     *
     * @type {boolean}
     */
    DISABLE_RINGING: false,

    /**
     * Whether the speech to text transcription subtitles panel is disabled.
     * If {@code undefined}, defaults to {@code false}.
     *
     * @type {boolean}
     */
    DISABLE_TRANSCRIPTION_SUBTITLES: false,

    /**
     * Whether or not the blurred video background for large video should be
     * displayed on browsers that can support it.
     */
    DISABLE_VIDEO_BACKGROUND: false,

    DISPLAY_WELCOME_PAGE_CONTENT: true,
    DISPLAY_WELCOME_PAGE_TOOLBAR_ADDITIONAL_CONTENT: false,

    ENABLE_FEEDBACK_ANIMATION: false, // Enables feedback star animation.

    FILM_STRIP_MAX_HEIGHT: 120,

    /**
     * Whether to only show the filmstrip (and hide the toolbar).
     */
    filmStripOnly: false,

    GENERATE_ROOMNAMES_ON_WELCOME_PAGE: true,

    /**
     * Hide the invite prompt in the header when alone in the meeting.
     */
    HIDE_INVITE_MORE_HEADER: false,

    INITIAL_TOOLBAR_TIMEOUT: 20000,
    JITSI_WATERMARK_LINK: 'https://jitsi.org',

    LANG_DETECTION: true, // Allow i18n to detect the system language
    LIVE_STREAMING_HELP_LINK: 'https://jitsi.org/live', // Documentation reference for the live streaming feature.
    LOCAL_THUMBNAIL_RATIO: 16 / 9, // 16:9

    /**
     * Maximum coeficient of the ratio of the large video to the visible area
     * after the large video is scaled to fit the window.
     *
     * @type {number}
     */
    MAXIMUM_ZOOMING_COEFFICIENT: 1.3,

    /**
     * Whether the mobile app Jitsi Meet is to be promoted to participants
     * attempting to join a conference in a mobile Web browser. If
     * {@code undefined}, defaults to {@code true}.
     *
     * @type {boolean}
     */
    MOBILE_APP_PROMO: true,

    NATIVE_APP_NAME: 'Jitsi Meet',

    // Names of browsers which should show a warning stating the current browser
    // has a suboptimal experience. Browsers which are not listed as optimal or
    // unsupported are considered suboptimal. Valid values are:
    // chrome, chromium, edge, electron, firefox, nwjs, opera, safari
    OPTIMAL_BROWSERS: [ 'chrome', 'chromium', 'nwjs', 'electron', 'firefox', 'safari' ],

    POLICY_LOGO: null,
    PROVIDER_NAME: 'Jitsi',

    /**
     * If true, will display recent list
     *
     * @type {boolean}
     */
    RECENT_LIST_ENABLED: true,
    REMOTE_THUMBNAIL_RATIO: 1, // 1:1

    SETTINGS_SECTIONS: [ 'devices', 'language', 'moderator', 'profile', 'calendar' ],
    SHOW_BRAND_WATERMARK: false,

    /**
    * Decides whether the chrome extension banner should be rendered on the landing page and during the meeting.
    * If this is set to false, the banner will not be rendered at all. If set to true, the check for extension(s)
    * being already installed is done before rendering.
    */
    SHOW_CHROME_EXTENSION_BANNER: true,

    SHOW_DEEP_LINKING_IMAGE: false,
    SHOW_JITSI_WATERMARK: true,
    SHOW_POWERED_BY: false,
    SHOW_PROMOTIONAL_CLOSE_PAGE: true,
    SHOW_WATERMARK_FOR_GUESTS: true, // if watermark is disabled by default, it can be shown only for guests

    /*
     * If indicated some of the error dialogs may point to the support URL for
     * help.
     */
    SUPPORT_URL: 'https://community.jitsi.org/',

    TOOLBAR_ALWAYS_VISIBLE: false,

    /**
     * The name of the toolbar buttons to display in the toolbar. If present,
     * the button will display. Exceptions are "livestreaming" and "recording"
     * which also require being a moderator and some values in config.js to be
     * enabled. Also, the "profile" button will not display for user's with a
     * jwt.
     */
    TOOLBAR_BUTTONS: [
        'microphone', 'camera', 'closedcaptions', 'desktop', 'fullscreen',
        'fodeviceselection', 'embedmeeting', 'hangup', 'profile', 'info', 'chat', 'recording',
        'livestreaming', 'etherpad', 'sharedvideo', 'settings', 'raisehand',
        'videoquality', 'filmstrip', 'invite', 'feedback', 'stats', 'shortcuts',
        'tileview', 'videobackgroundblur', 'download', 'help', 'mute-everyone',
        'e2ee'
    ],

    TOOLBAR_TIMEOUT: 4000,

    // Browsers, in addition to those which do not fully support WebRTC, that
    // are not supported and should show the unsupported browser page.
    UNSUPPORTED_BROWSERS: [],

    /**
     * Whether to show thumbnails in filmstrip as a column instead of as a row.
     */
    VERTICAL_FILMSTRIP: true,

    // Determines how the video would fit the screen. 'both' would fit the whole
    // screen, 'height' would fit the original video height to the height of the
    // screen, 'width' would fit the original video width to the width of the
    // screen respecting ratio.
    VIDEO_LAYOUT_FIT: 'both',

    /**
     * If true, hides the video quality label indicating the resolution status
     * of the current large video.
     *
     * @type {boolean}
     */
    VIDEO_QUALITY_LABEL_DISABLED: false

    /**
     * When enabled, the kick participant button will not be presented for users without a JWT
     */
    // HIDE_KICK_BUTTON_FOR_GUESTS: false,

    /**
     * How many columns the tile view can expand to. The respected range is
     * between 1 and 5.
     */
    // TILE_VIEW_MAX_COLUMNS: 5,

    /**
     * Specify custom URL for downloading android mobile app.
     */
    // MOBILE_DOWNLOAD_LINK_ANDROID: 'https://play.google.com/store/apps/details?id=org.jitsi.meet',

    /**
     * Specify URL for downloading ios mobile app.
     */
    // MOBILE_DOWNLOAD_LINK_IOS: 'https://itunes.apple.com/us/app/jitsi-meet/id1165103905',

    /**
     * Specify Firebase dynamic link properties for the mobile apps.
     */
    // MOBILE_DYNAMIC_LINK: {
    //    APN: 'org.jitsi.meet',
    //    APP_CODE: 'w2atb',
    //    CUSTOM_DOMAIN: undefined,
    //    IBI: 'com.atlassian.JitsiMeet.ios',
    //    ISI: '1165103905'
    // },

    /**
     * Specify mobile app scheme for opening the app from the mobile browser.
     */
    // APP_SCHEME: 'org.jitsi.meet',

    /**
     * Specify the Android app package name.
     */
    // ANDROID_APP_PACKAGE: 'org.jitsi.meet',

    /**
     * Override the behavior of some notifications to remain displayed until
     * explicitly dismissed through a user action. The value is how long, in
     * milliseconds, those notifications should remain displayed.
     */
    // ENFORCE_NOTIFICATION_AUTO_DISMISS_TIMEOUT: 15000,

    // List of undocumented settings
    /**
     INDICATOR_FONT_SIZES
     PHONE_NUMBER_REGEX
    */
};

/* eslint-enable no-unused-vars, no-var, max-len */
</script>

    <script>
	/* eslint-disable no-unused-vars, no-var */

// Logging configuration
var loggingConfig = {
    // default log level for the app and lib-jitsi-meet
    defaultLogLevel: 'trace',

    // Option to disable LogCollector (which stores the logs on CallStats)
    // disableLogCollector: true,

    // The following are too verbose in their logging with the
    // {@link #defaultLogLevel}:
    'modules/RTC/TraceablePeerConnection.js': 'info',
    'modules/statistics/CallStats.js': 'info',
    'modules/xmpp/strophe.util.js': 'log'
};

/* eslint-enable no-unused-vars, no-var */

// XXX Web/React server-includes logging_config.js into index.html.
// Mobile/react-native requires it in react/features/base/logging. For the
// purposes of the latter, (try to) export loggingConfig. The following
// detection of a module system is inspired by webpack.
typeof module === 'object'
    && typeof exports === 'object'
    && (module.exports = loggingConfig);
</script>

    <script src="libs/lib-jitsi-meet.min.js?v=4370.993"></script>
    <script src="libs/app.bundle.min.js?v=4370.993"></script>