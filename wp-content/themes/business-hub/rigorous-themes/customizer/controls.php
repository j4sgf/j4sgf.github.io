<?php
/**
 * Business Hub Theme Custom Customizer Controls.
 *
 * @package Business_Hub
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
  return NULL;
}

/**
 * Customize Category Control.
 */

if (class_exists('WP_Customize_Control') && ! class_exists( 'Business_Hub_Customize_Category_Control' ) ) {

    class Business_Hub_Customize_Category_Control extends WP_Customize_Control {
        /**
         * Render the control's content.
         *
         * @since 3.4.0
         */
        public function render_content() {
            $dropdown = wp_dropdown_categories(
                array(
                    'name'              => 'business-hub-dropdown-categories-' . $this->id,
                    'echo'              => 0,
                    'show_option_none'  => __( '&mdash; Select &mdash;', 'business-hub' ),
                    'option_none_value' => '0',
                    'selected'          => $this->value(),
                    'hide_empty'        => 0,                   

                )
            ); 
            
            $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
 
            printf(
                '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s <span class="description customize-control-description"></span>%s </label>',
                $this->label,
                $this->description,
                $dropdown

            );
        }
    }
}

/**
 * Customize sidebar layout control.
 */

if (class_exists('WP_Customize_Control') && ! class_exists( 'Business_Hub_Customize_Sidebar_Control' ) ) {

    class Business_Hub_Customize_Sidebar_Control extends WP_Customize_Control {
        public function render_content() {

            if ( empty( $this->choices ) )
                return;

            $name = '_customize-radio-' . $this->id;

            ?>
            <style>
                #business-hub-layouts-container li {
                    float: left;
                    display: inline;
                    text-align: left;
                    width: 45%;
                    margin-left: 12px;
                }
                              
                #business-hub-layouts-container li img.business-hub-sidebar-img {         
                   cursor: pointer;   
                   border: 3px solid #E4E4E4; 
                   border-radius: 3px;
                    -moz-border-radius: 3px;
                    -webkit-border-radius: 3px;              
                }

                #business-hub-layouts-container li img.business-hub-sidebar-img-selected {
                    border: 3px solid #BCBCBC;                    
                }
                
            </style>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <ul class="controls" id='business-hub-layouts-container'>
            <?php
                foreach ( $this->choices as $value => $label ) :

                    $class = ($this->value() == $value) ? 'business-hub-sidebar-img-selected business-hub-sidebar-img' : 'business-hub-sidebar-img';
                    ?>
                    <li>
                    <label>
                        <input <?php $this->link(); ?>style = 'display:none' type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
                        <img src = '<?php echo esc_html( $label ); ?>' class = '<?php echo $class; ?>' />
                    </label>
                    </li>
                    <?php
                endforeach;
            ?>
            </ul>
            <script type="text/javascript">

                jQuery(document).ready(function($) {
                    $('#business-hub-layouts-container li label img').click(function(){
                        $('#business-hub-layouts-container li').each(function(){
                            $(this).find('img').removeClass ('business-hub-sidebar-img-selected') ;
                        });
                        $(this).addClass ('business-hub-sidebar-img-selected') ;
                    });                    
                });

            </script>
            <?php
        }
    }
}

if (class_exists('WP_Customize_Control') && ! class_exists( 'Business_Hub_Customize_Info_Control' ) ) {

    class Business_Hub_Customize_Info_Control extends WP_Customize_Control {
        /**
         * Render the control's content.
         *
         * @since 3.4.0
         */
        public function render_content() {        
 
          printf(
            '<label class="customize-control-info"><span class="customize-control-title">%s</span>
            <span class="description customize-control-description">%s</span></label>',
            $this->label, 
            $this->description
            );
        }
    }
}
