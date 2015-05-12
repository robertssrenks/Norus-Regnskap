(function() {
	tinymce.PluginManager.add( 'symple_shortcodes_mce_button', function( editor, url ) {
		editor.addButton( 'symple_shortcodes_mce_button', {
			title: 'Goldenworks Shortcodes',
			type: 'menubutton',
			icon: 'icon symple-shortcodes-icon',
			menu: [


				/** Columns Start **/
				{
				text: 'Columns',
				menu: [

						/* New Row */
						{
							text: 'New Row',
							onclick: function() {
								editor.insertContent( '[new_row]<br /> Your Content <br />[/new_row]');
							}
						}, // End New Row
						
						
						/* One Half */
						{
							text: 'One Half',
							onclick: function() {
								editor.insertContent( '[one_half]<br /> Your Content <br />[/one_half]');
							}
						}, // End One Half						
						
						
						/* One Third */
						{
							text: 'One Third',
							onclick: function() {
								editor.insertContent( '[one_third]<br /> Your Content <br />[/one_third]');
							}
						}, // End One Third	
						
							
						/* One Fourth */
						{
							text: 'One Fourth',
							onclick: function() {
								editor.insertContent( '[one_fourth]<br /> Your Content <br />[/one_fourth]');
							}
						}, // End One Fourth	
						
							
						/* One Fifth Offset */
						{
							text: 'One Fifth Offset',
							onclick: function() {
								editor.insertContent( '[one_fifth_offset]<br /> Your Content <br />[/one_fifth_offset]');
							}
						}, // End One Fifth Offset
						
						
						/* One Fifth */
						{
							text: 'One Fifth',
							onclick: function() {
								editor.insertContent( '[one_fifth]<br /> Your Content <br />[/one_fifth]');
							}
						}, // End One Fifth						
						
						
						/* Two Thirds */
						{
							text: 'Two Thirds',
							onclick: function() {
								editor.insertContent( '[two_third]<br /> Your Content <br />[/two_third]');
							}
						}, // Two Thirds		
						
						
						/* Three Fourths */
						{
							text: 'Three Fourths',
							onclick: function() {
								editor.insertContent( '[three_fourth]<br /> Your Content <br />[/three_fourth]');
							}
						}, // Three Fourths	
						
						
						/* Percent Block */
						{
							text: 'Percent Block',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Percent Block',
									body: [ {
										type: 'textbox', 
										name: 'percentblockWidth', 
										label: 'Div width in percent',
										value: '50%'
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[percentblock width="' + e.data.percentblockWidth + '"]<br /> Your Content <br />[/percentblock]');
									}
								});
							}
						}, // Percent Block																	
						

					]
				}, // End Columns section



				/** Elements Start **/
				{
				text: 'Elements',
				menu: [
						
						/* Header Section */
						{
							text: 'Header Section',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Header Section',
									body: [ 

									
									// Title text
									{
										type: 'textbox', 
										name: 'headerSampleTitle', 
										label: 'Title',
										value: 'Sample Title'
									} ,									
									
									// Image
									{
										type: 'textbox', 
										name: 'headerImage', 
										label: 'Absolute url to image',
										value: '#'
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[header title="' + e.data.headerSampleTitle + '" image="' + e.data.headerImage + '"]<br /> Your Content <br />[/header]');
									}
								});
							}
						}, // End Header Section							
						
						
						/* Title Line */
						{
							text: 'Title Line',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Title With Line',
									body: [ {
										type: 'textbox', 
										name: 'titlelineTitle', 
										label: 'Title',
										value: 'Sample Title'
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[titleline title="' + e.data.titlelineTitle + '"]');
									}
								});
							}
						}, // End Title Line											
						

						/* Divider */
						{
							text: 'Divider',
							onclick: function() {
								editor.insertContent( '[divider]');
							}
						}, // End Divider

						
						/* Button */
						{
							text: 'Button',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Button',
									body: [ 


									// Color
									{
										type: 'listbox',
										name: 'buttonColor',
										label: 'Button Color',
										'values': [
											{text: 'transparent', value: 'trans'},
											{text: 'current skin', value: 'skin'},
											{text: 'red', value: 'red'},
											{text: 'light green', value: 'lightgreen'},
											{text: 'green', value: 'green'},
											{text: 'orange', value: 'orange'},
											{text: 'yellow', value: 'yellow'},
											{text: 'pink', value: 'lightgreen'},
											{text: 'dark pink', value: 'darkpink'},
											{text: 'purple', value: 'purple'},
											{text: 'violet', value: 'violet'},
											{text: 'blue', value: 'blue'},
											{text: 'teal', value: 'teal'},
											{text: 'white', value: 'white'},
											{text: 'light gray', value: 'lightgray'},
											{text: 'dark gray', value: 'darkgray'}																																																						
										]										
									},
										
									// Url
									{
										type: 'textbox', 
										name: 'buttonUrl', 
										label: 'Url',
										value: '#'
									},											
																		
									// Title
									{
										type: 'textbox', 
										name: 'buttonTitle', 
										label: 'Title',
										value: 'Sample Title'
									},									

									// Target
									{
										type: 'listbox',
										name: 'buttonTarget',
										label: 'Target',
										'values': [
											{text: 'blank', value: '_blank'},
											{text: 'self', value: '_self'},
											{text: 'parent', value: '_parent'},
											{text: 'top', value: '_top'}
										]										
									},
										
									// Shadow
									{
										type: 'listbox',
										name: 'buttonShadow',
										label: 'Shadow',
										'values': [
											{text: 'true', value: 'true'},
											{text: 'false', value: 'false'}
										]										
									},										
																		
									// Icon
									{
										type: 'textbox', 
										name: 'buttonIcon', 
										label: 'Icon Code',
										value: 'fa-arrow-circle-right'
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[button url="' + e.data.buttonUrl + '" color="' + e.data.buttonColor + '" title="' + e.data.buttonTitle + '" target="' + e.data.buttonTarget + '" icon="' + e.data.buttonIcon + '" shadow="' + e.data.buttonShadow + '"]Your Button Text[/button]');
									}
								});
							}
						}, // End Button							
						
						
						
						
						/* Border List Wrapper */
						{
							text: 'Border List',
							onclick: function() {
								editor.insertContent( '[borderlist]<br /> Your Content <br />[/borderlist]');
							}
						}, // Border List Wrapper						
						
						
						
						/* Border List Item */
						{
							text: 'Border List Item',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Border List Item',
									body: [ 
									
									// Title
									{
										type: 'textbox', 
										name: 'borderlistitemTitle', 
										label: 'Title',
										value: 'Sample Title'
									},
									
									// Title
									{
										type: 'textbox', 
										name: 'borderlistitemUrl', 
										label: 'Url',
										value: '#'
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[borderlist_item title="' + e.data.borderlistitemTitle + '" url="' + e.data.borderlistitemUrl + '"]');
									}
								});
							}
						}, // Border List Item						
						
						
						
						/* Call To Action */
						{
							text: 'Call To Action',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Call To Action',
									body: [ 
									
									// Border
									{
										type: 'textbox', 
										name: 'ctaBorder', 
										label: 'border color code',
										value: '#e4e4e4'
									},
									
									// Left Border
									{
										type: 'textbox', 
										name: 'ctaLeftborder', 
										label: 'Left border color code',
										value: ''
									},									
									
									// Background
									{
										type: 'textbox', 
										name: 'borderBackground', 
										label: 'Background color code',
										value: '#fff'
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[cta border="' + e.data.ctaBorder + '" background="' + e.data.borderBackground + '" left_border="' + e.data.ctaLeftborder + '"]<br /> Your Content <br />[/cta]');
									}
								});
							}
						}, // Call To Action						
						
						
							
						/* Teaser */
						{
							text: 'Teaser',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Teaser',
									body: [ 
									
									// Title
									{
										type: 'textbox', 
										name: 'teaserTitle', 
										label: 'Title',
										value: 'Sample Title'
									},
										
									// Image
									{
										type: 'textbox', 
										name: 'teaserImage', 
										label: 'Absolute url to image',
										value: '#'
									},		
									
									// Url
									{
										type: 'textbox', 
										name: 'teaserUrl', 
										label: 'Teaser links to:',
										value: '#'
									},
									
									// Icon
									{
										type: 'textbox', 
										name: 'teaserIcon', 
										label: 'Icon Code',
										value: 'fa-arrow-circle-right'
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[teaser title="' + e.data.teaserTitle + '" image="' + e.data.teaserImage + '" url="' + e.data.teaserUrl + '" icon="' + e.data.teaserIcon + '"]');
									}
								});
							}
						}, // Teaser											
						
						

						{
							text: 'Testimonial Slider',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Testimonial Slider',
									body: [ 
									
									// Image
									{
										type: 'textbox', 
										name: 'tslideImage', 
										label: 'Slide 1 Testimonial Author Picture Url',
										value: '#'
									},
										
									// Name
									{
										type: 'textbox', 
										name: 'tslideName', 
										label: 'Slide 1 Testimonial Author',
										value: '#'
									},		
									
									// Url
									{
										type: 'textbox', 
										name: 'tslidePosition', 
										label: 'Slide 1 Testimonial Author Position',
										value: 'Company CEO'
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[testimonial_slider]<br />[tslide image="' + e.data.tslideImage + '" name="' + e.data.tslideName + '" position="' + e.data.tslidePosition + '"]<br />Testimonial Text Message<br />[/tslide]<br />[/testimonial_slider]' );
									}
								});
							}
						}, 				
						
						
						
						{
							text: 'Testimonial Section',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Testimonial Section',
									body: [ 
									
									// Image
									{
										type: 'textbox', 
										name: 'tsectionImage', 
										label: 'Testimonial Section Author Picture Url',
										value: '#'
									},
										
									// Name
									{
										type: 'textbox', 
										name: 'tsectionName', 
										label: 'Testimonial Section Author',
										value: '#'
									},		
									
									// Url
									{
										type: 'textbox', 
										name: 'tsectionPosition', 
										label: 'Testimonial Section Author Position',
										value: 'Company CEO'
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[testimonial_section image="' + e.data.tsectionImage + '" name="' + e.data.tsectionName + '" position="' + e.data.tsectionPosition + '"]<br />Testimonial Text Message<br />[/testimonial_section]' );
									}
								});
							}
						}, 	
						
						
						
						{
							text: 'Content Slider',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Content Slider',
									body: [ 

									// Title
									{
										type: 'textbox', 
										name: 'cslideTitle', 
										label: 'Content Slide 1 Title',
										value: '#'
									},
									
																		
									// Image
									{
										type: 'textbox', 
										name: 'cslideImage', 
										label: 'Content Slide 1 Image',
										value: '#'
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[content_slider]<br />[cslide image="' + e.data.cslideImage + '" title="' + e.data.cslideTitle + '"]<br />[/content_slider]' );										
									}
								});
							}
						}, 	
						
						
						
						{
							text: 'Content Bar',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Content Bar',
									body: [ 

									// Bg Image
									{
										type: 'textbox', 
										name: 'contentbarImage', 
										label: 'Absolute Url To Background Image',
										value: '#'
									},
									
																		
									// Bg Color
									{
										type: 'textbox', 
										name: 'contentbarBgColor', 
										label: 'Background Color Code',
										value: '#f8f8f8'
									},
									
									
									// Textcolor
									{
										type: 'textbox', 
										name: 'contentbarTextcolor', 
										label: 'Text Color Code',
										value: ''
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[contentbar][contentbar_section bgcolor="' + e.data.contentbarBgColor + '" bgimg="' + e.data.contentbarImage + '" textcolor="' + e.data.contentbarTextcolor + '"]<br />Text inside content bar<br />[/contentbar_section][/contentbar]' );																				
									}
								});
							}
						}, 						
						
						
											
						{
							text: 'Lightbox',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Lightbox',
									body: [ 

									// Url
									{
										type: 'textbox', 
										name: 'lightboxUrl', 
										label: 'Absolute Url To Fullsize Image',
										value: ''
									},
									
									
									// Thumbnail
									{
										type: 'textbox', 
										name: 'lightboxThumb', 
										label: 'Absolute Url To Thumbnail Image',
										value: ''
									},									
									
																		
									// Title
									{
										type: 'textbox', 
										name: 'lightboxTitle', 
										label: 'Lightbox Title',
										value: 'Sample Title'
									},
									
									// Target
									{
										type: 'listbox',
										name: 'lightboxAlign',
										label: 'Alignment',
										'values': [
											{text: 'left', value: 'left'},
											{text: 'right', value: 'right'}
										]										
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[lightbox url="' + e.data.lightboxUrl + '" thumbnail="' + e.data.lightboxThumb + '" title="' + e.data.lightboxTitle + '" align="' + e.data.lightboxAlign + '"]' );
									}
								});
							}
						}, 	
						

						// Pricing Table						
						{
							text: 'Pricing Table',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Pricing Table',
									body: [ 


									// Width
									{
										type: 'textbox', 
										name: 'ptableWidth', 
										label: 'Table Width In Percent',
										value: '25%'
									},
									

									// Plan
									{
										type: 'textbox', 
										name: 'ptablePlan', 
										label: 'Pricing Table Plan',
										value: 'Starter'
									},	
									
																		
									// Cost
									{
										type: 'textbox', 
										name: 'ptableCost', 
										label: 'Pricing Plan Cost',
										value: '19'
									},
									
										
									// Per
									{
										type: 'textbox', 
										name: 'ptablePer', 
										label: 'Pricing Plan Cost Per',
										value: 'month'
									},
									
																											
									// Coin
									{
										type: 'textbox', 
										name: 'ptableCoin', 
										label: 'Price Coin',
										value: '$'
									},
									
									
									// Button Text
									{
										type: 'textbox', 
										name: 'ptableBtntxt', 
										label: 'Action Button Text',
										value: 'Sign Up!'
									},
										
										
									// Height
									{
										type: 'textbox', 
										name: 'ptableHeight', 
										label: 'Pricing Table Block Height',
										value: '585px'
									},										
									
									
									// Border Right
									{
										type: 'listbox',
										name: 'ptableBorderRight',
										label: 'Border Right',
										'values': [
											{text: 'true', value: 'true'},
											{text: 'false', value: 'false'}
										]										
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[pricing_table width="' + e.data.ptableWidth + '" coin="' + e.data.ptableCoin + '" plan="' + e.data.ptablePlan + '" per="' + e.data.ptablePer + '" cost="' + e.data.ptableCost + '" button_text="' + e.data.ptableBtntxt + '" border_right="' + e.data.ptableBorderRight + '" height="' + e.data.ptableHeight + '"]<br />Pricing Table Content<br />[/pricing_table]' );
									}
								});
							}
						}, 						



						// Pricing Table List
						{
							text: 'Pricing Table List',
							onclick: function() {
								editor.insertContent( '[table_list]<br />[tlist_item]<br />pricing table list item<br />[/tlist_item]<br />[/table_list]' );
							}
						},
						
							
							
						// Skill Chart
						{
							text: 'Skill Chart',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Skill Chart',
									body: [ 

									
									// Title
									{
										type: 'textbox', 
										name: 'skillchartTitle', 
										label: 'Title',
										value: 'Sample Title'
									},


									// Color
									{
										type: 'textbox', 
										name: 'skillchartColor', 
										label: 'Color',
										value: '#d20e1c'
									},


									// Percent
									{
										type: 'textbox', 
										name: 'skillchartPercent', 
										label: 'Skill Percent',
										value: '85'
									},
																		
																		
									// Border Right
									{
										type: 'listbox',
										name: 'skillchartBorderRight',
										label: 'Border Right',
										'values': [
											{text: 'true', value: 'true'},
											{text: 'false', value: 'false'}
										]										
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[skillchart percent="' + e.data.skillchartPercent + '" title="' + e.data.skillchartTitle + '" color1="' + e.data.skillchartColor + '" border_right="' + e.data.skillchartBorderRight + '"]<br />skill chart content<br />[/skillchart]' );
									}
								});
							}
						}, 						
						
						
						
						// Skill Bar
						{
							text: 'Skill Bar',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Skill Bar',
									body: [ 

									
									// Title
									{
										type: 'textbox', 
										name: 'skillbarTitle', 
										label: 'Skill Name',
										value: 'Sample Name Example'
									},


									// Color
									{
										type: 'textbox', 
										name: 'skillbarColor', 
										label: 'Color',
										value: '#d20e1c'
									},


									// Percent
									{
										type: 'textbox', 
										name: 'skillbarPercent', 
										label: 'Skill Percent',
										value: '100'
									},
																		
																		
									// Show Percent
									{
										type: 'listbox',
										name: 'skillbarPercent',
										label: 'Display percent ?',
										'values': [
											{text: 'true', value: 'true'},
											{text: 'false', value: 'false'}
										]										
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[skillbar title="' + e.data.skillbarTitle + '" percentage="' + e.data.skillbarPercent + '" color="' + e.data.skillbarColor + '" show_percent="' + e.data.skillbarPercent + '"]' );
									}
								});
							}
						}, 							
						
						
						
						// Google Map
						{
							text: 'Google Map',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Google Map',
									body: [ 

									
									// Title
									{
										type: 'textbox', 
										name: 'googlemapTitle', 
										label: 'Location Title',
										value: 'Envato Office'
									},


									// Location
									{
										type: 'textbox', 
										name: 'googlemapLocation', 
										label: 'Location Address',
										value: '2 Elizabeth St, Melbourne Victoria 3000 Australia'
									},


									// Zoom
									{
										type: 'textbox', 
										name: 'googlemapZoom', 
										label: 'Map Zoom',
										value: '10'
									},
										
										
									// Height
									{
										type: 'textbox', 
										name: 'googlemapHeight', 
										label: 'Map Canvas Height',
										value: '250'
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[googlemap title="' + e.data.googlemapTitle + '" location="' + e.data.googlemapLocation + '" zoom="' + e.data.googlemapZoom + '" height="' + e.data.googlemapHeight + '"]' );										
									}
								});
							}
						}						
						

					]
				}, // End Elements section




				/** Team Start **/
				{
				text: 'Team',
				menu: [

						
						/* Team Section */
						{
							text: 'Team Section',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Team Section',
									body: [ 
									
									//Name
									{
										type: 'textbox', 
										name: 'teamsectionName', 
										label: 'Div width in percent',
										value: '50%'
									},


									//Position
									{
										type: 'textbox', 
										name: 'teamsectionPosition', 
										label: 'Position',
										value: 'Company CEO'
									},
									
									
									//Image
									{
										type: 'textbox', 
										name: 'teamsectionImage', 
										label: 'Team Member Image Url',
										value: '#'
									},									
									

									//Twitter								
									{
										type: 'textbox', 
										name: 'teamsectionTwitter', 
										label: 'Twitter Profile Link',
										value: ''
									},
									
									
									//Facebook								
									{
										type: 'textbox', 
										name: 'teamsectionFacebook', 
										label: 'Facebook Profile Link',
										value: ''
									},
									
									
									//Linkedin								
									{
										type: 'textbox', 
										name: 'teamsectionLinkedin', 
										label: 'Linkedin Profile Link',
										value: ''
									},
										
																		
									//Google Plus								
									{
										type: 'textbox', 
										name: 'teamsectionGooglePlus', 
										label: 'Google Plus Profile Link',
										value: ''
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[teamsection name="' + e.data.teamsectionName + '" position="' + e.data.teamsectionPosition + '" image="' + e.data.teamsectionImage + '" twitter="' + e.data.teamsectionTwitter + '" facebook="' + e.data.teamsectionFacebook + '" linkedin="' + e.data.teamsectionLinkedin + '" googleplus="' + e.data.teamsectionGooglePlus + '"]<br />Team member description<br />[/teamsection]');
									}
								});
							}
						}, // Team Section																	
						



						/* Team Block */
						{
							text: 'Team Block',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Team Block',
									body: [ 
									
									//Name
									{
										type: 'textbox', 
										name: 'teamblockName', 
										label: 'Div width in percent',
										value: '50%'
									},


									//Position
									{
										type: 'textbox', 
										name: 'teamblockPosition', 
										label: 'Position',
										value: 'Company CEO'
									},
									
									
									//Image
									{
										type: 'textbox', 
										name: 'teamblockImage', 
										label: 'Team Member Image Url',
										value: '#'
									},									
									

									//Twitter								
									{
										type: 'textbox', 
										name: 'teamblockTwitter', 
										label: 'Twitter Profile Link',
										value: ''
									},
									
									
									//Facebook								
									{
										type: 'textbox', 
										name: 'teamblockFacebook', 
										label: 'Facebook Profile Link',
										value: ''
									},
									
									
									//Linkedin								
									{
										type: 'textbox', 
										name: 'teamblockLinkedin', 
										label: 'Linkedin Profile Link',
										value: ''
									},
										
																		
									//Google Plus								
									{
										type: 'textbox', 
										name: 'teamblockGooglePlus', 
										label: 'Google Plus Profile Link',
										value: ''
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[teamblock name="' + e.data.teamblockName + '" position="' + e.data.teamblockPosition + '" image="' + e.data.teamblockImage + '" twitter="' + e.data.teamblockTwitter + '" facebook="' + e.data.teamblockFacebook + '" linkedin="' + e.data.teamblockLinkedin + '" googleplus="' + e.data.teamblockGooglePlus + '"]<br />Team member description<br />[/teamblock]');
									}
								});
							}
						}, // Team Block	
						
						
						
						
						/* Team Entry */
						{
							text: 'Team Entry',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Team Entry',
									body: [ 
									
									//Name
									{
										type: 'textbox', 
										name: 'teamentryName', 
										label: 'Div width in percent',
										value: '50%'
									},


									//Position
									{
										type: 'textbox', 
										name: 'teamentryPosition', 
										label: 'Position',
										value: 'Company CEO'
									},
									
									
									//Image
									{
										type: 'textbox', 
										name: 'teamentryImage', 
										label: 'Team Member Image Url',
										value: '#'
									},									
									

									//Twitter								
									{
										type: 'textbox', 
										name: 'teamentryTwitter', 
										label: 'Twitter Profile Link',
										value: ''
									},
									
									
									//Facebook								
									{
										type: 'textbox', 
										name: 'teamentryFacebook', 
										label: 'Facebook Profile Link',
										value: ''
									},
									
									
									//Linkedin								
									{
										type: 'textbox', 
										name: 'teamentryLinkedin', 
										label: 'Linkedin Profile Link',
										value: ''
									},
										
																		
									//Google Plus								
									{
										type: 'textbox', 
										name: 'teamentryGooglePlus', 
										label: 'Google Plus Profile Link',
										value: ''
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[teamentry name="' + e.data.teamentryName + '" position="' + e.data.teamentryPosition + '" image="' + e.data.teamentryImage + '" twitter="' + e.data.teamentryTwitter + '" facebook="' + e.data.teamentryFacebook + '" linkedin="' + e.data.teamentryLinkedin + '" googleplus="' + e.data.teamentryGooglePlus + '"]<br />Team member description<br />[/teamentry]');
									}
								});
							}
						} // Team Entry							
						

					]
				}, // End Team section




				/** Typography Start **/
				{
				text: 'Typography',
				menu: [

						/* Intro */
						{
							text: 'Intro',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Intro',
									body: [


									// Text Align
									{
										type: 'listbox',
										name: 'introTextalign',
										label: 'Text Align',
										'values': [
											{text: 'left', value: 'left'},
											{text: 'right', value: 'right'},
											{text: 'center', value: 'center'}											
										]										
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[intro textalign="' + e.data.introTextalign + '"]<br />Sample Text<br />[/intro]');
									}
								});
							}
						}, // Intro	
						
						
						/* Left pullquote */
						{
							text: 'Left pullquote',
							onclick: function() {
								editor.insertContent( '[pullquote_left]<br /> Sample Text <br />[/pullquote_left]');
							}
						}, // Left pullquote						
						
						
						/* Right pullquote */
						{
							text: 'Right pullquote',
							onclick: function() {
								editor.insertContent( '[pullquote_right]<br /> Sample Text <br />[/pullquote_right]');
							}
						}, // Right pullquote	
						
						
						/* Dropcap */
						{
							text: 'Dropcap',
							onclick: function() {
								editor.insertContent( '[dropcap]Dropcap text[/dropcap]');
							}
						}, // Dropcap
						
						
						/* Highlight */
						{
							text: 'Highlight',
							onclick: function() {
								editor.insertContent( '[highlight]highlighted text[/highlight]');
							}
						}, // Highlight						
						
						
						
						{
							text: 'Text Color',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Text Color',
									body: [ 
									
									//Text Color
									{
										type: 'textbox', 
										name: 'textcolorColor', 
										label: 'Text Color Code',
										value: ''
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[textcolor color="' + e.data.textcolorColor + '"]<br />Colored text<br />[/textcolor]');
									}
								});
							}
						}, 
						
						
						
						{
							text: 'Custom List',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Custom List',
									body: [ 
									
									//Indent
									{
										type: 'textbox', 
										name: 'customlistIndent', 
										label: 'Indent',
										value: '10px'
									},
									
									//Icon
									{
										type: 'textbox', 
										name: 'customlistIcon', 
										label: 'First List Item Icon',
										value: 'fa fa-chevron-circle-right'
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[customlist indent="' + e.data.customlistIndent + '"]<br />[list_item icon="' + e.data.customlistIcon + '"]<br />list item[/list_item]<br />[/customlist]');
									}
								});
							}
						}, 						
						
						
						
						{
							text: 'Underlined Header',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Underlined Header',
									body: [ 
									
									//Underline Color
									{
										type: 'textbox', 
										name: 'ulineheaderColor', 
										label: 'Underlined Header Color',
										value: ''
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[hline color="' + e.data.ulineheaderColor + '"]<br />Header Text<br />[/hline]');
									}
								});
							}
						}, 						
						
																								


					]
				}, // End Typography section




				/** Boxes Start **/
				{
				text: 'Boxes',
				menu: [


						
						{
							text: 'Small Box',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Small Box',
									body: [ 
									
									
									//Background
									{
										type: 'textbox', 
										name: 'smallboxBg', 
										label: 'Background',
										value: '#d4ffed'
									},
									
									
									//Color
									{
										type: 'textbox', 
										name: 'smallboxColor', 
										label: 'Text Color',
										value: '#217653'
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[smallbox background="' + e.data.smallboxBg + '" color="' + e.data.smallboxColor + '"]<br />Sample text<br />[/smallbox]');
									}
								});
							}
						}, 
						
						
						
						
						{
							text: 'Normal Box',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Normal Box',
									body: [ 
									
									
									//Background
									{
										type: 'textbox', 
										name: 'normalboxBg', 
										label: 'Background',
										value: '#d20e1c'
									},
									
									
									//Color
									{
										type: 'textbox', 
										name: 'normalboxColor', 
										label: 'Text Color',
										value: '#ffffff'
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[normalbox background="' + e.data.normalboxBg + '" color="' + e.data.normalboxColor + '"]<br />Sample text<br />[/normalbox]');
									}
								});
							}
						}, 						
						
						
						
						
						{
							text: 'Icon Box',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Icon Box',
									body: [ 
									
									
									//Background
									{
										type: 'textbox', 
										name: 'iconboxBg', 
										label: 'Background',
										value: '#d20e1c'
									},
									
									
									//Color
									{
										type: 'textbox', 
										name: 'iconboxColor', 
										label: 'Text Color',
										value: '#ffffff'
									},
									
									
									//Icon
									{
										type: 'textbox', 
										name: 'iconboxIcon', 
										label: 'Icon',
										value: 'fa-info-circle"'
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[iconbox background="' + e.data.iconboxBg + '" color="' + e.data.iconboxColor + '" icon="' + e.data.iconboxIcon + '"]<br />Sample text<br />[/iconbox]');
									}
								});
							}
						}, 							
						
						
						
						
						{
							text: 'Icon Block',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Icon Block',
									body: [ 
									
									
									//Title
									{
										type: 'textbox', 
										name: 'iconblockTitle', 
										label: 'Title',
										value: 'Online Charts'
									},
									
									
									//Color
									{
										type: 'textbox', 
										name: 'iconblockColor', 
										label: 'Text Color',
										value: '#ffffff'
									},
									
									
									//Icon
									{
										type: 'textbox', 
										name: 'iconblockIcon', 
										label: 'Icon',
										value: 'fa-info-circle"'
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[iconblock title="' + e.data.iconblockTitle + '" color="' + e.data.iconblockColor + '" icon="' + e.data.iconblockIcon + '"]');
									}
								});
							}
						},						
						
						
						
						
						
						{
							text: 'Modal Lightbox',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Modal Lightbox',
									body: [ 
									
									
									//Title
									{
										type: 'textbox', 
										name: 'modalTitle', 
										label: 'Title',
										value: 'Modal Lightbox Title'
									},
									
									
									//Close Title
									{
										type: 'textbox', 
										name: 'modalCtitle', 
										label: 'Close Title Text',
										value: 'Close Window'
									},									
									

									//Effect
									{
										type: 'listbox',
										name: 'modalId',
										label: 'Effect',
										'values': [
											{text: 'Fade in & Scale', value: '1'},
											{text: 'Slide In (Right)', value: '2'},
											{text: 'Slide In (Bottom)', value: '3'},
											{text: 'Newspaper', value: '4'},
											{text: 'Fall', value: '5'},
											{text: 'Side Fall', value: '6'},
											{text: 'Sticky Up', value: '7'},
											{text: '3D Flip (Horizontal)', value: '8'},
											{text: '3D Flip (Vertical)', value: '9'},
											{text: '3D Sign', value: '10'},
											{text: 'Super Scaled', value: '11'},
											{text: 'Just Me', value: '12'},
											{text: '3D Slit', value: '13'},
											{text: '3D Rotate Bottom', value: '14'},
											{text: '3D Rotate In Left', value: '15'},
											{text: 'Blur', value: '16'},
											{text: 'Let Me In', value: '17'},
											{text: 'Make Way', value: '18'},
											{text: 'Slip From Top', value: '19'},																																																																																						
										]										
									},



									//Icon
									{
										type: 'listbox',
										name: 'modalIcon',
										label: 'Icon',
										'values': [
											{text: 'true', value: 'true'},
											{text: 'false', value: 'false'}																																																																																					
										]										
									},


									
									//Border
									{
										type: 'listbox',
										name: 'modalBorder',
										label: 'Border',
										'values': [
											{text: 'true', value: 'true'},
											{text: 'false', value: 'false'}																																																																																					
										]										
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[modal_lightbox title="' + e.data.modalTitle + '" ctitle="' + e.data.modalCtitle + '" effect="' + e.data.modalId + '" id="modal-1" icon="' + e.data.modalIcon + '" border="' + e.data.modalBorder + '"]<br />Sample Text<br />[/modal_lightbox] ');
									}
								});
							}
						}							


					]
				}, // End Boxes section




				/** Typography Start **/
				{
				text: 'Services',
				menu: [



						{
							text: 'Icon Service',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Icon Service',
									body: [ 
									
									
									//Text Color
									{
										type: 'textbox', 
										name: 'iserviceTitle', 
										label: 'Title',
										value: 'Sample Title'
									},
									
									
									//Icon
									{
										type: 'textbox', 
										name: 'iserviceIcon', 
										label: 'Icon',
										value: 'fa-heart-o'
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[iservice title="' + e.data.iserviceTitle + '" icon="' + e.data.iserviceIcon + '"]<br />Sample text<br />[/iservice]');
									}
								});
							}
						}, 
						
						
						
						
						{
							text: 'Left Icon Service',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Left Icon Service',
									body: [ 
									
									
									//Icon
									{
										type: 'textbox', 
										name: 'liserviceIcon', 
										label: 'Icon',
										value: 'fa-umbrella'
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[liservice icon="' + e.data.liserviceIcon + '"]<br />Sample text<br />[/liservice]');
									}
								});
							}
						}, 						
						
						


						{
							text: 'Icon List Service',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Left Icon Service',
									body: [ 
									
									
									//Icon
									{
										type: 'textbox', 
										name: 'ilserviceIcon', 
										label: 'Icon',
										value: 'fa-star-o'
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[ilservice icon="' + e.data.ilserviceIcon + '"]<br />Sample text<br />[/ilservice]');
									}
								});
							}
						},
						
						
						
						
						{
							text: 'Lines Icon Service',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Lines Icon Service',
									body: [ 
									
									
									//Width
									{
										type: 'textbox', 
										name: 'siserviceWidth', 
										label: 'Width',
										value: '33.3333%'
									},
									
																	
									//Icon
									{
										type: 'textbox', 
										name: 'siserviceIcon', 
										label: 'Icon',
										value: 'fa-cloud-upload'
									},
									
									
									//Border Left
									{
										type: 'listbox',
										name: 'siserviceBorderLeft',
										label: 'Border Left',
										'values': [
											{text: 'true', value: 'true'},
											{text: 'false', value: 'false'}																																																																																					
										]										
									},									
									
									
									//Border Bottom
									{
										type: 'listbox',
										name: 'siserviceBorderBottom',
										label: 'Border Bottom',
										'values': [
											{text: 'true', value: 'true'},
											{text: 'false', value: 'false'}																																																																																					
										]										
									},									
									
									
									//Color 
									{
										type: 'textbox', 
										name: 'siserviceColor', 
										label: 'Color',
										value: '#d20e1c'
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[siservice width="' + e.data.siserviceWidth + '" icon="' + e.data.siserviceIcon + '" borderleft="' + e.data.siserviceBorderLeft + '" borderbottom="' + e.data.siserviceBorderBottom + '" color="' + e.data.siserviceColor + '" height=""]<br />Sample text<br />[/siservice]' );
									}
								});
							}
						},						
						
						
						
						
						{
							text: 'Big Icon Service',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Big Icon Service',
									body: [ 
									

									//Url
									{
										type: 'textbox', 
										name: 'biserviceUrl', 
										label: 'Service Links To:',
										value: ''
									},
									
																		
									//Icon
									{
										type: 'textbox', 
										name: 'biserviceIcon', 
										label: 'Icon',
										value: 'fa-heart-o'
									},
									
									
									//Color 
									{
										type: 'textbox', 
										name: 'biserviceColor', 
										label: 'Color',
										value: '#d20e1c'
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[biservice icon="' + e.data.biserviceIcon + '" color="' + e.data.biserviceColor + '" url="' + e.data.biserviceUrl + '"]<br />Sample text<br />[/biservice]' );
									}
								});
							}
						},						
						
						
						
						
						{
							text: 'Rectangular icon service',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Rectangular icon service',
									body: [ 
									

									//Title
									{
										type: 'textbox', 
										name: 'riserviceTitle', 
										label: 'Title',
										value: 'Modal Lightbox Title'
									},
									
																		
									//Icon
									{
										type: 'textbox', 
										name: 'riserviceIcon', 
										label: 'Icon',
										value: 'fa-heart-o'
									},
									
									
									//Icon Color
									{
										type: 'textbox', 
										name: 'riserviceIconColor', 
										label: 'Icon Color',
										value: '#d20e1c'
									},
																		
									
									//Icon Background
									{
										type: 'textbox', 
										name: 'riserviceIconBg', 
										label: 'Icon Background',
										value: '#f8f8f8'
									},
									
																		
									//TextColor 
									{
										type: 'textbox', 
										name: 'riserviceTextColor', 
										label: 'Text Color',
										value: '#6d6d6d'
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[riservice title="' + e.data.riserviceTitle + '" icon="' + e.data.riserviceIcon + '"  icon_color="' + e.data.riserviceIconColor + '" icon_background="' + e.data.riserviceIconBg + '" text_color="' + e.data.riserviceTextColor + '"]<br />Sample text<br />[/biservice]' );
									}
								});
							}
						},	
						
						
						
						
						{
							text: 'Smart Service Box',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Smart Service Box',
									body: [ 
									

									//Title
									{
										type: 'textbox', 
										name: 'smartserviceTitle', 
										label: 'Title',
										value: 'Sample Title'
									},
									
																		
									//Icon
									{
										type: 'textbox', 
										name: 'smartserviceIcon', 
										label: 'Icon',
										value: 'fa-heart-o'
									},
									
									
									//Icon Color
									{
										type: 'textbox', 
										name: 'smartserviceIconColor', 
										label: 'Icon Color',
										value: '#ffffff'
									},									
									
									
									//Background
									{
										type: 'textbox', 
										name: 'smartserviceBg', 
										label: 'Background',
										value: '#f8f8f8'
									},
									
									
									//Icon Background
									{
										type: 'textbox', 
										name: 'smartserviceIconBg', 
										label: 'Icon Background',
										value: '#d20e1c'
									},
																											
									
									//Text Color 
									{
										type: 'textbox', 
										name: 'smartserviceTextColor', 
										label: 'Text Color',
										value: '#6d6d6d'
									},
									
									
									//Height 
									{
										type: 'textbox', 
										name: 'smartserviceHeight', 
										label: 'Height',
										value: ''
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[smartservice title="' + e.data.smartserviceTitle + '" icon="' + e.data.smartserviceIcon + '" icon_color="' + e.data.smartserviceIconColor + '" icon_background="' + e.data.smartserviceIconBg + '" text_color="' + e.data.smartserviceTextColor + '" background="' + e.data.biserviceIcon + '" height="' + e.data.smartserviceBg + '"]<br />Sample text<br />[/smartservice]' );
									}
								});
							}
						},
						
						
						
						
						{
							text: 'Process Box',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Process Box',
									body: [ 
									

									//Title
									{
										type: 'textbox', 
										name: 'processboxTitle', 
										label: 'Title',
										value: 'Title Sample'
									},
									
																		
									//Icon
									{
										type: 'textbox', 
										name: 'processboxIcon', 
										label: 'Icon',
										value: 'icon-light-bulb'
									},
									
									
									//Url
									{
										type: 'textbox', 
										name: 'processboxUrl', 
										label: 'Process Box Links To:',
										value: ''
									},
									
																		
									//Arrow 
									{
										type: 'listbox', 
										name: 'processboxArrow', 
										label: 'Display Arrow ?',
										'values': [
											{text: 'true', value: 'true'},
											{text: 'false', value: 'false'}										
										]	
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[processbox title="' + e.data.processboxTitle + '" icon="' + e.data.processboxIcon + '" url="' + e.data.processboxUrl + '" arrow="' + e.data.processboxArrow + '"]Sample Text[/processbox]' );
									}
								});
							}
						},	
						
						
												
						
						{
							text: 'Process Service',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Process Service',
									body: [ 
									
										
									//Color
									{
										type: 'textbox', 
										name: 'processserviceColor', 
										label: 'Color',
										value: '#d20e1c'
									},	
									
																											
									//Icon
									{
										type: 'textbox', 
										name: 'processserviceIcon', 
										label: 'Icon',
										value: 'fa fa-lightbulb-o'
									},
									
									
									//Number
									{
										type: 'textbox', 
										name: 'processserviceNumber', 
										label: 'Number',
										value: '1'
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[process_service color="' + e.data.processserviceColor + '" icon="' + e.data.processserviceIcon + '" number="' + e.data.processserviceNumber + '"]Sample Text[/process_service]' );
									}
								});
							}
						}		
																							


					]
				}, // End Services section
				
				
				


				/** jQuery Start **/
				{
				text: 'jQuery',
				menu: [



						/* Accordion */
						{
							text: 'Accordion',
							onclick: function() {
								editor.insertContent( '[accordion]<br />[accordion_section title="Section 1"]<br />Accordion Content<br />[/accordion_section]<br />[accordion_section title="Section 2"]<br />Accordion Content<br />[/accordion_section]<br />[/accordion]');
							}
						}, // Accordion	



						/* Toggle */
						{
							text: 'Toggle',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Text Color',
									body: [ 
									
									//Title
									{
										type: 'textbox', 
										name: 'toggleTitle', 
										label: 'Title',
										value: 'Toggle Title'
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[toggle title="' + e.data.toggleTitle + '"]<br />Toggle content<br />[/toggle]');
									}
								});
							}
						}, 
						


						/* Tabs */
						{
							text: 'Tabs',
							onclick: function() {
								editor.insertContent( '[tabgroup]<br />[tab title="Tab 1" icon="fa"]<br />Tab Content<br />[/tab]<br />[tab title="Tab 2" icon="fa"]<br />Tab Content<br />[/tab]<br />[/tabgroup]');
							}
						} // Tabs	
																		


					]
				}, // End jQuery section





				/** Latest Posts Start **/
				{
				text: 'Latest Posts',
				menu: [



						/* Latest Posts */
						{
							text: 'Latest Posts',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Latest Posts',
									body: [ 
									
									
									//Number of posts
									{
										type: 'textbox', 
										name: 'latestpostsNumber', 
										label: 'Number of Posts',
										value: '4'
									},

									
									//Columns
									{
										type: 'textbox', 
										name: 'latestpostsColumns', 
										label: 'Columns',
										value: '3'
									},
																		
									
									//Section
									{
										type: 'textbox', 
										name: 'latestpostsSection', 
										label: 'Section(Category Slug)',
										value: ''
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[latest_blog qty="' + e.data.latestpostsNumber + '" columns="' + e.data.latestpostsColumns + '" section="' + e.data.latestpostsSection + '"]');
									}
								});
							}
						}, 
						
						
						
						
						/* Latest Posts Alternative */
						{
							text: 'Latest Posts Alternative',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Latest Posts Alternative',
									body: [ 
									
									
									//Number of posts
									{
										type: 'textbox', 
										name: 'latestpostsaltNumber', 
										label: 'Number of Posts',
										value: '3'
									},
																		
									
									//Section
									{
										type: 'textbox', 
										name: 'latestpostsaltSection', 
										label: 'Section(Category Slug)',
										value: ''
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[latest_blog_alt qty="' + e.data.latestpostsaltNumber + '" section="' + e.data.latestpostsaltSection + '"]');
									}
								});
							}
						},						
						



						/* Latest Classic Portfolio Posts */
						{
							text: 'Latest Classic Portfolio Posts',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Latest Classic Portfolio Posts',
									body: [ 
									
									
									//Number of posts
									{
										type: 'textbox', 
										name: 'latestportcNumber', 
										label: 'Number of Posts',
										value: '4'
									},
																		
									
									//Columns
									{
										type: 'textbox', 
										name: 'latestportcColumns', 
										label: 'Columns',
										value: '4'
									},
									
																		
									//Section
									{
										type: 'textbox', 
										name: 'latestportcSection', 
										label: 'Section(Category Slug)',
										value: ''
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[latestportc qty="' + e.data.latestportcNumber + '" columns="' + e.data.latestportcColumns + '" section="' + e.data.latestportcSection + '"]');
									}
								});
							}
						},	
						
						
						
						
						/* Latest Grid Portfolio Posts */
						{
							text: 'Latest Grid Portfolio Posts',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Latest Grid Portfolio Posts',
									body: [ 
									
									
									//Number of posts
									{
										type: 'textbox', 
										name: 'latestportgNumber', 
										label: 'Number of Posts',
										value: '4'
									},
																		
									
									//Columns
									{
										type: 'textbox', 
										name: 'latestportgColumns', 
										label: 'Columns',
										value: '4'
									},
									
																		
									//Section
									{
										type: 'textbox', 
										name: 'latestportgSection', 
										label: 'Section(Category Slug)',
										value: ''
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[latestportg qty="' + e.data.latestportgNumber + '" columns="' + e.data.latestportgColumns + '" section="' + e.data.latestportgSection + '"]');
									}
								});
							}
						}			


					]
				}, // End Latest Posts section





				/** Other Start **/
				{
				text: 'Other',
				menu: [


						/* Spacing */
						{
							text: 'Spacing',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Spacing',
									body: [ 
									
									
									//Size
									{
										type: 'textbox', 
										name: 'spacingSize', 
										label: 'Size',
										value: '20px'
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[spacing size="' + e.data.spacingSize + '"]');
									}
								});
							}
						}, 
						
						

						/* Clear Floats */
						{
							text: 'Clear Floats',
							onclick: function() {
								editor.insertContent( '[clearboth]');
							}
						}, // Clear Floats						
						
						
						
						/* Sidebar Anywhere */
						{
							text: 'Sidebar Anywhere',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Sidebar Anywhere',
									body: [ 
									
									
									//Name
									{
										type: 'textbox', 
										name: 'gwsidebarName', 
										label: 'Name',
										value: 'default sidebar'
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[gwsidebar name="' + e.data.gwsidebarName + '"]');
									}
								});
							}
						}, 
						
						
						
						/* Social Media Wrapper */
						{
							text: 'Social Media Wrapper',
							onclick: function() {
								editor.insertContent( '[socialmedia]Social Media Content[/socialmedia]');
							}
						}, 						
						
						
						
						{
							text: 'Social Media Icon',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Social Media Icon',
									body: [ 
									
									
									//Title
									{
										type: 'textbox', 
										name: 'smiconTitle', 
										label: 'Title',
										value: 'Twitter'
									},
									
									
									
									//Url
									{
										type: 'textbox', 
										name: 'smiconUrl', 
										label: 'Url',
										value: '#'
									},
									
									
									
									//Icon
									{
										type: 'textbox', 
										name: 'smiconIcon', 
										label: 'Icon',
										value: 'absolute path to icon'
									},
									
									
									//Tooltip position
									{
										type: 'textbox', 
										name: 'smiconTooltip', 
										label: 'Tooltip Position',
										'values': [
											{text: 'Top', value: 'top'},
											{text: 'Bottom', value: 'bottom'}
										]
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[socialmedia_icon title="' + e.data.smiconTitle + '" url="' + e.data.smiconUrl + '" icon="' + e.data.smiconIcon + '" tooltip_position="' + e.data.smiconTooltip + '"]');
										
									}
								});
							}
						}, 						
						
						
						
						/* Social media share article */
						{
							text: 'Social media share article',
							onclick: function() {
								editor.windowManager.open( {
									title: 'GW Shortcodes - Social media share article',
									body: [ 
									
									
									//Title
									{
										type: 'textbox', 
										name: 'smiconshareTitle', 
										label: 'Title',
										value: 'Spread the word!'
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[socialmedia_share title="' + e.data.smiconshareTitle + '"]');
									}
								});
							}
						}, 						
						
						
					]
				}, // End Other section




			]
		});
	});
})();