( function( api ) {

	// Extends our custom "businessdeal" section.
	api.sectionConstructor['businessdeal'] = api.Section.extend( {

		// No businessdeal for this type of section.
		attachEuphoric: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
