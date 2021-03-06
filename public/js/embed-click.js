/**
 * Disqus variables.
 */
var disqus_url = embedVars.disqusUrl;
var disqus_identifier = embedVars.disqusIdentifier;
var disqus_container_id = 'disqus_thread';
var disqus_shortname = embedVars.disqusShortname;
var disqus_title = embedVars.disqusTitle;
var disqus_config_custom = window.disqus_config;
var disqus_loaded = false;
var disqus_button = document.getElementById('dcl_comment_btn');
var disqus_config = function () {
    /**
     * All currently supported events:
     * onReady: fires when everything is ready,
     * onNewComment: fires when a new comment is posted,
     * onIdentify: fires when user is authenticated
     */
    var dsqConfig = embedVars.disqusConfig;
    this.page.integration = dsqConfig.integration;
    this.page.remote_auth_s3 = dsqConfig.remote_auth_s3;
    this.page.api_key = dsqConfig.api_key;
    this.sso = dsqConfig.sso;
    this.language = dsqConfig.language;

    if (disqus_config_custom)
        disqus_config_custom.call(this);
};

/**
 * Get and set the Disqus comments embed.
 *
 * Get the Disqus comments iframe through ajax
 * and append it to the comments section.
 *
 * @since 11.0.0
 */
var disqus_comments = function() {

    if ( ! disqus_loaded ) {
        disqus_loaded = true;
        var dsq = document.createElement( 'script' );
        dsq.type = 'text/javascript';
        dsq.async = true;
        dsq.src = 'https://' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName( 'head' )[0] || document.getElementsByTagName( 'body' )[0]).appendChild( dsq );
    }
};

/**
 * Load Disqus comments on button click.
 *
 * Load Disqus comments when visitor clicks on load
 * comments button.
 *
 * @since 11.0.0
 */
if ( disqus_button ) {
    disqus_button.onclick = function () {
        // Show progress if not already shown.
        if ( document.getElementById( 'dcl_progress' ) === null ) {
            // Show one temporary loading message.
            var tmp_p = document.createElement( 'p' ),
                tmp_text = document.createTextNode( dclCustomVars.dcl_progress_text );
            tmp_p.appendChild( tmp_text );
            tmp_p.setAttribute( 'id', 'dcl_progress' );
            // Append temporary message to comments div.
            document.getElementById( 'dcl_btn_container' ).appendChild( tmp_p );
        }
        // Remove button.
        this.remove();
        disqus_comments();
    }
}
