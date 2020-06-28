( function( api ) {

	// Extends our custom "upgarde-pro" section.
	api.sectionConstructor['upgarde-pro'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
