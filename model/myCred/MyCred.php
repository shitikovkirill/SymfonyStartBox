<?php
namespace Bunch\Model\MyCred;

class My_Custom_Hook extends \myCRED_Hook {
    function __construct( $hook_prefs ) {
        // Construct
        parent::__construct( array(
            'id'       => 'custom',
            'defaults' => array(
                'instance_one' => array(
                    'creds'    => 10,
                    'log'      => '%plural% for first instance'
                ),
                'instance_two' => array(
                    'creds'    => 5,
                    'log'      => '%plural% for second instance'
                )
            )
        ), $hook_prefs );
    }

    public function run() {
        // Multiple instances needs to be checked as one of them might be disabled
        // leaving us with just one active instance.
        if ( $this->prefs['instance_one']['creds'] != 0 )
            add_action( 'one_hook_id', array( $this, 'hook_method_first' ) );
        if ( $this->prefs['instance_two']['creds'] != 0 )
            add_action( 'another_hook_id', array( $this, 'hook_method_second' ) );
    }

    public function hook_method_first() {
        // Do what you need to do to add/deduct points when this hook fired.
        // You can name this method anything you want but it should be something
        // that reflects the instance. i.e. new_post or logging_in.
    }

    public function hook_method_second() {
        // Do what you need to do to add/deduct points when this hook fired.
        // You can name this method anything you want but it should be something
        // that reflects the instance. i.e. new_post or logging_in.
    }

    public function preferences() {
        // Our preferences are available under $this->prefs
        $prefs = $this->prefs; ?>

        <!-- First we set the amount -->
        <label class="subheader"><?php echo $this->core->template_tags_general( '%plural% for Instance One' ); ?></label>
        <ol>
            <li>
                <div class="h2"><input type="text" name="<?php echo $this->field_name( array( 'instance_one', 'creds' ) ); ?>" id="<?php echo $this->field_id( array( 'instance_one', 'creds' ) ); ?>" value="<?php echo $this->core->format_number( $prefs['instance_one']['creds'] ); ?>" size="8" /></div>
            </li>
        </ol>
        <!-- Then the log template -->
        <label class="subheader"><?php _e( 'Log template', 'mycred' ); ?></label>
        <ol>
            <li>
                <div class="h2"><input type="text" name="<?php echo $this->field_name( array( 'instance_one', 'log' ) ); ?>" id="<?php echo $this->field_id( array( 'instance_one', 'log' ) ); ?>" value="<?php echo $prefs['instance_one']['log']; ?>" class="long" /></div>
            </li>
        </ol>
        <!-- First we set the amount -->
        <label class="subheader"><?php echo $this->core->template_tags_general( '%plural% for Instance Two' ); ?></label>
        <ol>
            <li>
                <div class="h2"><input type="text" name="<?php echo $this->field_name( array( 'instance_two', 'creds' ) ); ?>" id="<?php echo $this->field_id( array( 'instance_two', 'creds' ) ); ?>" value="<?php echo $this->core->format_number( $prefs['instance_two']['creds'] ); ?>" size="8" /></div>
            </li>
        </ol>
        <!-- Then the log template -->
        <label class="subheader"><?php _e( 'Log template', 'mycred' ); ?></label>
        <ol>
            <li>
                <div class="h2"><input type="text" name="<?php echo $this->field_name( array( 'instance_two', 'log' ) ); ?>" id="<?php echo $this->field_id( array( 'instance_two', 'log' ) ); ?>" value="<?php echo $prefs['instance_two']['log']; ?>" class="long" /></div>
            </li>
        </ol>
        <?php
    }
}