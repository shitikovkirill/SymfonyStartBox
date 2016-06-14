<?php
namespace Bunch\Model\MyCred;

class Registration extends \myCRED_Hook {

    /**
     * Construct
     */
    function __construct( $hook_prefs, $type ) {
        parent::__construct( array(
            'id'       => 'complete_profile',
            'defaults' => array(
                'creds'   => 1,
                'log'     => '%plural% for completing your profile'
            )
        ), $hook_prefs, $type );
    }

    /**
     * Hook into WordPress
     */
    public function run() {
        // Since we are running a single instance, we do not need to check
        // if points are set to zero (disable). myCRED will check if this
        // hook has been enabled before calling this method so no need to check
        // that either.
        add_action( 'personal_options_update',  array( $this, 'profile_update' ) );
        add_action( 'edit_user_profile_update', array( $this, 'profile_update' ) );
    }

    /**
     * Check if the user qualifies for points
     */
    public function profile_update( $user_id ) {
        // Check if user is excluded (required)
        if ( $this->core->exclude_user( $user_id ) ) return;

        // Check to see if user has filled in their first and last name
        if ( empty( $_POST['first_name'] ) || empty( $_POST['last_name'] ) ) return;

        // Make sure this is a unique event
        if ( $this->has_entry( 'completing_profile', '', $user_id ) ) return;

        // Execute
        $this->core->add_creds(
            'completing_profile',
            $user_id,
            $this->prefs['creds'],
            $this->prefs['log'],
            0,
            '',
            $m
        );
    }

    /**
     * Add Settings
     */
    public function preferences() {
        // Our settings are available under $this->prefs
        $prefs = $this->prefs; ?>

        <!-- First we set the amount -->
        <label class="subheader"><?php echo $this->core->plural(); ?></label>
        <ol>
            <li>
                <div class="h2"><input type="text" name="<?php echo $this->field_name( 'creds' ); ?>" id="<?php echo $this->field_id( 'creds' ); ?>" value="<?php echo $this->core->format_number( $prefs['creds'] ); ?>" size="8" /></div>
            </li>
        </ol>
        <!-- Then the log template -->
        <label class="subheader"><?php _e( 'Log template', 'mycred' ); ?></label>
        <ol>
            <li>
                <div class="h2"><input type="text" name="<?php echo $this->field_name( 'log' ); ?>" id="<?php echo $this->field_id( 'log' ); ?>" value="<?php echo $prefs['log']; ?>" class="long" /></div>
            </li>
        </ol>
        <?php
    }

    /**
     * Sanitize Preferences
     */
    public function sanitise_preferences( $data ) {
        $new_data = $data;

        // Apply defaults if any field is left empty
        $new_data['creds'] = ( !empty( $data['creds'] ) ) ? $data['creds'] : $this->defaults['creds'];
        $new_data['log'] = ( !empty( $data['log'] ) ) ? sanitize_text_field( $data['log'] ) : $this->defaults['log'];

        return $new_data;
    }
}
?>