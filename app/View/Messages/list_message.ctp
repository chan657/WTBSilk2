	<div class="row">
							<div class="col-sm-12">
								<div class="bordered_heading">
									<div class="row">
										<div class="col-sm-3 col-md-2">
											<h1 class="heading_lg">Inbox</h1>
										</div>
										<div class="col-sm-4 col-md-4 mbox_table_actions">
											<div class="btn-group btn-group-sm">
												<button class="btn btn-default" type="button"><span class="icon-reply"></span></button>
												<button class="btn btn-default" type="button"><span class="icon-exclamation"></span></button>
												<button class="btn btn-default" type="button"><span class="icon-trash"></span></button>
											</div>
										</div>
										<div class="col-sm-3 col-md-4 col-sm-offset-2 mbox_table_actions">
											<input type="text" id="mailbox_search" class="form-control" placeholder="Find message">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-3 col-md-2">
										<div class="mailbox_nav">
											<div class="sepH_b">
												<a data-toggle="modal" href="#newMail" class="btn btn-default btn-sm">New Email</a>
											</div>
											<ul class="nav nav-pills nav-stacked">
												<li class="active"><a href="#">Inbox</a></li>
												<li><a href="#">Outbox</a></li>
												<li><a href="#">Important</a></li>
												<li><a href="#">Spam</a></li>
												<li><a href="#">Trash</a></li>
											</ul>
										</div>
									</div>
									<div class="col-sm-9 col-md-10">
										<div class="mailbox_content">
											<table id="mailbox_table" class="table toggle-square" data-filter="#mailbox_search" data-page-size="20" data-provides="rowlink">
												<thead>
													<tr>
														<th><label class="checkbox-inline"><input type="checkbox" class="mbox_select_all" name="msg_sel_all"></label></th>
														<th></th>
														<th data-hide="phone,tablet">From</th>
														<th>Subject</th>
														<th data-hide="phone">Date</th>
													</tr>
												</thead>
												<tbody>
													<tr class="unreaded">
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Jada Conn</td>
														<td><a href="#mbox_preview">Quaerat rerum ipsa earum unde velit.</a></td>
														<td>today</td>
													</tr>
													<tr class="unreaded">
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Mrs. Adah Konopelski DVM</td>
														<td><a href="#mbox_preview">Maxime magni vitae exercitationem.</a></td>
														<td>today</td>
													</tr>
													<tr class="unreaded">
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Derick Crona IV</td>
														<td><a href="#mbox_preview">Atque optio enim architecto veritatis corrupti.</a></td>
														<td>yesterday</td>
													</tr>
													<tr class="unreaded">
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Nadia Reynolds</td>
														<td><a href="#mbox_preview">Minima dignissimos perspiciatis veritatis molestiae perferendis.</a></td>
														<td>yesterday</td>
													</tr>
													<tr class="unreaded">
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star"></span></td>
														<td>Althea Ledner</td>
														<td><a href="#mbox_preview">Et sed error perspiciatis magnam aliquam.</a></td>
														<td>yesterday</td>
													</tr>
													<tr class="unreaded">
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Allie Zemlak</td>
														<td><a href="#mbox_preview">Provident omnis eum quia illo.</a></td>
														<td>yesterday</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Dr. Andreane Lowe</td>
														<td><a href="#mbox_preview">Aut excepturi et quia dignissimos unde.</a></td>
														<td>Nov 2</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Myrtie Block</td>
														<td><a href="#mbox_preview">Voluptates incidunt praesentium necessitatibus aut molestiae.</a></td>
														<td>Nov 13</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Mable Bechtelar DDS</td>
														<td><a href="#mbox_preview">Ex quam accusantium consequatur doloribus.</a></td>
														<td>Nov 2</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Durward Kiehn</td>
														<td><a href="#mbox_preview">Impedit dolor ex aspernatur corrupti.</a></td>
														<td>Nov 15</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Arnaldo Brakus</td>
														<td><a href="#mbox_preview">Tenetur ut earum provident rerum.</a></td>
														<td>Nov 19</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Dr. Bennett Dicki Jr.</td>
														<td><a href="#mbox_preview">Fugiat explicabo cumque saepe.</a></td>
														<td>Nov 25</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Mrs. Cole Wiegand III</td>
														<td><a href="#mbox_preview">Sint unde id aliquid.</a></td>
														<td>Nov 10</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Dr. Letha Dickinson DVM</td>
														<td><a href="#mbox_preview">Odio unde iusto et ut.</a></td>
														<td>Nov 17</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Kelli Schuster</td>
														<td><a href="#mbox_preview">Occaecati sint recusandae adipisci impedit.</a></td>
														<td>Nov 6</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star"></span></td>
														<td>Albin Veum</td>
														<td><a href="#mbox_preview">Ut sequi repellat.</a></td>
														<td>Nov 9</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Eve Boyer</td>
														<td><a href="#mbox_preview">Ipsam dolores et aspernatur temporibus nihil.</a></td>
														<td>Nov 14</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Zackery Wyman</td>
														<td><a href="#mbox_preview">Blanditiis quia inventore laboriosam ea non.</a></td>
														<td>Nov 15</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Emil Kertzmann</td>
														<td><a href="#mbox_preview">Amet quos veritatis voluptas quam.</a></td>
														<td>Nov 15</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Mike Nicolas</td>
														<td><a href="#mbox_preview">Impedit adipisci dolorem rerum et qui.</a></td>
														<td>Nov 8</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Colton Parisian</td>
														<td><a href="#mbox_preview">Dolores et provident sunt et reprehenderit.</a></td>
														<td>Nov 7</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Ramiro Kling</td>
														<td><a href="#mbox_preview">Exercitationem modi facilis.</a></td>
														<td>Nov 2</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Maiya Mante</td>
														<td><a href="#mbox_preview">Minus velit natus et.</a></td>
														<td>Nov 7</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star"></span></td>
														<td>Miss Cooper Rowe IV</td>
														<td><a href="#mbox_preview">Eveniet id modi dignissimos.</a></td>
														<td>Nov 16</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Alek Pouros</td>
														<td><a href="#mbox_preview">Ex aperiam vel voluptatum architecto.</a></td>
														<td>Nov 13</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Mr. Virginia Schulist DVM</td>
														<td><a href="#mbox_preview">Quo unde deleniti non.</a></td>
														<td>Nov 1</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star"></span></td>
														<td>Ashly Pfeffer</td>
														<td><a href="#mbox_preview">Reiciendis dolorum nihil ex sit.</a></td>
														<td>Nov 25</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Lillie Roberts</td>
														<td><a href="#mbox_preview">Harum minus numquam.</a></td>
														<td>Nov 13</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Jaylen Grimes Sr.</td>
														<td><a href="#mbox_preview">Sunt quam dolores.</a></td>
														<td>Nov 20</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Glennie Douglas</td>
														<td><a href="#mbox_preview">Dolorum ut pariatur cum dolores.</a></td>
														<td>Nov 17</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Maegan Heller</td>
														<td><a href="#mbox_preview">Dolor officiis harum.</a></td>
														<td>Nov 25</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Jaqueline Lowe</td>
														<td><a href="#mbox_preview">Inventore et quisquam ab quam.</a></td>
														<td>Nov 14</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Ms. Christophe Kilback</td>
														<td><a href="#mbox_preview">Quod quibusdam molestiae sed.</a></td>
														<td>Nov 23</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Damon Herman</td>
														<td><a href="#mbox_preview">Perspiciatis maiores quod ex.</a></td>
														<td>Nov 12</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Albertha Metz</td>
														<td><a href="#mbox_preview">Eum possimus animi delectus dolores.</a></td>
														<td>Nov 5</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Abbie Roob</td>
														<td><a href="#mbox_preview">Facere eius dolores nemo voluptatem cupiditate.</a></td>
														<td>Nov 21</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Osborne Torphy</td>
														<td><a href="#mbox_preview">Fugit natus enim.</a></td>
														<td>Nov 15</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star"></span></td>
														<td>Miss Ruthe Aufderhar DVM</td>
														<td><a href="#mbox_preview">Autem consectetur labore.</a></td>
														<td>Nov 7</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Alta Huels</td>
														<td><a href="#mbox_preview">Quibusdam blanditiis beatae facilis.</a></td>
														<td>Nov 8</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Noah Reynolds III</td>
														<td><a href="#mbox_preview">Ipsum hic minima rerum.</a></td>
														<td>Nov 16</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Kelli Hilll</td>
														<td><a href="#mbox_preview">Quidem aspernatur tempora harum nemo.</a></td>
														<td>Nov 21</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Vincenzo McKenzie</td>
														<td><a href="#mbox_preview">Illum rerum sunt cupiditate.</a></td>
														<td>Nov 26</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Karli Metz Sr.</td>
														<td><a href="#mbox_preview">Eius sit pariatur repudiandae necessitatibus quisquam.</a></td>
														<td>Nov 15</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Myrtie Kovacek</td>
														<td><a href="#mbox_preview">Est aliquam placeat quo non.</a></td>
														<td>Nov 4</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Dwight Kerluke</td>
														<td><a href="#mbox_preview">Sed adipisci sit.</a></td>
														<td>Nov 17</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Felicity Schmitt</td>
														<td><a href="#mbox_preview">Et quaerat excepturi tempora.</a></td>
														<td>Nov 20</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Mr. Rylan Zieme</td>
														<td><a href="#mbox_preview">Iusto perferendis aliquam molestiae.</a></td>
														<td>Nov 13</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Kurt Larkin</td>
														<td><a href="#mbox_preview">Repellat delectus distinctio.</a></td>
														<td>Nov 5</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Deonte Kuphal</td>
														<td><a href="#mbox_preview">Explicabo cupiditate fugit molestias et.</a></td>
														<td>Nov 9</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Dr. Ryleigh Ernser</td>
														<td><a href="#mbox_preview">Mollitia sunt autem beatae quisquam.</a></td>
														<td>Nov 1</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Dawn Hoppe</td>
														<td><a href="#mbox_preview">Et est voluptatem natus accusantium.</a></td>
														<td>Nov 12</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Bernie Sauer</td>
														<td><a href="#mbox_preview">Omnis culpa nobis repellendus et enim.</a></td>
														<td>Nov 15</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Lily Kiehn</td>
														<td><a href="#mbox_preview">Magnam nisi natus commodi.</a></td>
														<td>Nov 2</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Madalyn Bergnaum</td>
														<td><a href="#mbox_preview">Nam esse vero est et in.</a></td>
														<td>Nov 18</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Dr. Ludie Kihn</td>
														<td><a href="#mbox_preview">Architecto facilis soluta quia ut aliquid.</a></td>
														<td>Nov 5</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Dillan Towne</td>
														<td><a href="#mbox_preview">Est quia dolorem atque tempora.</a></td>
														<td>Nov 14</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Darryl Okuneva</td>
														<td><a href="#mbox_preview">Qui sunt rerum.</a></td>
														<td>Nov 19</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Belle Ankunding</td>
														<td><a href="#mbox_preview">Nihil itaque odio.</a></td>
														<td>Nov 3</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Ms. Reuben Wilderman II</td>
														<td><a href="#mbox_preview">Quis ab dolorem iure.</a></td>
														<td>Nov 26</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Mr. Rubie Marvin V</td>
														<td><a href="#mbox_preview">Architecto sapiente blanditiis.</a></td>
														<td>Nov 12</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Eloy Lynch</td>
														<td><a href="#mbox_preview">Porro id autem.</a></td>
														<td>Nov 20</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Mr. Celine Daniel</td>
														<td><a href="#mbox_preview">In ex accusantium facilis rerum.</a></td>
														<td>Nov 25</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Mrs. Jakayla Baumbach Sr.</td>
														<td><a href="#mbox_preview">Sint sed id molestias aliquid.</a></td>
														<td>Nov 25</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Electa Crooks</td>
														<td><a href="#mbox_preview">Libero quae quaerat adipisci perspiciatis.</a></td>
														<td>Nov 17</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Jolie Lemke</td>
														<td><a href="#mbox_preview">Voluptatem animi dignissimos distinctio.</a></td>
														<td>Nov 10</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Alfred Corwin</td>
														<td><a href="#mbox_preview">Numquam quia et in facere.</a></td>
														<td>Nov 4</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Mrs. Desmond Hackett V</td>
														<td><a href="#mbox_preview">Perspiciatis delectus qui delectus harum.</a></td>
														<td>Nov 11</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Kailyn Muller</td>
														<td><a href="#mbox_preview">Impedit provident ullam sed.</a></td>
														<td>Nov 24</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Eryn Mann</td>
														<td><a href="#mbox_preview">Fugiat et ex aliquid et.</a></td>
														<td>Nov 11</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Mrs. Dante Lesch</td>
														<td><a href="#mbox_preview">Et est assumenda consequatur.</a></td>
														<td>Nov 18</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Ms. Macy Marquardt MD</td>
														<td><a href="#mbox_preview">Quasi aut in aliquam neque.</a></td>
														<td>Nov 14</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Christop Emmerich</td>
														<td><a href="#mbox_preview">Dolorum dignissimos accusantium distinctio odio.</a></td>
														<td>Nov 5</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Miss Otto Huel</td>
														<td><a href="#mbox_preview">Ut nam porro sit eius.</a></td>
														<td>Nov 18</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Leanne Lubowitz</td>
														<td><a href="#mbox_preview">Sunt rem exercitationem doloribus culpa.</a></td>
														<td>Nov 3</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Jose Weimann</td>
														<td><a href="#mbox_preview">Sed sint enim enim.</a></td>
														<td>Nov 9</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Murray Smitham</td>
														<td><a href="#mbox_preview">Aliquam quis et atque qui quo.</a></td>
														<td>Nov 9</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Mr. Maynard Sanford</td>
														<td><a href="#mbox_preview">Et amet qui iste.</a></td>
														<td>Nov 23</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Dr. Zelma Thompson</td>
														<td><a href="#mbox_preview">Unde eaque quis dignissimos.</a></td>
														<td>Nov 21</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Daisy Hills</td>
														<td><a href="#mbox_preview">Doloribus numquam distinctio sed modi soluta.</a></td>
														<td>Nov 13</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Bethel Jacobi</td>
														<td><a href="#mbox_preview">Incidunt iste similique quo est.</a></td>
														<td>Nov 5</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Aiyana Labadie V</td>
														<td><a href="#mbox_preview">Cupiditate qui enim quae quis provident.</a></td>
														<td>Nov 21</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Mark Hegmann DVM</td>
														<td><a href="#mbox_preview">Nemo natus assumenda aut.</a></td>
														<td>Nov 24</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Dr. Faye Ledner III</td>
														<td><a href="#mbox_preview">Ut exercitationem impedit molestiae amet.</a></td>
														<td>Nov 20</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Robbie Goyette</td>
														<td><a href="#mbox_preview">Tempore neque quo neque.</a></td>
														<td>Nov 22</td>
													</tr>
													<tr>
														<td class="nolink"><input type="checkbox" name="msg_sel" class="mbox_msg_select" /></td>
														<td class="nolink mbox_star"><span class="icon-star-empty"></span></td>
														<td>Ms. Rodrigo Zboncak I</td>
														<td><a href="#mbox_preview">Quia praesentium modi debitis.</a></td>
														<td>Nov 16</td>
													</tr>
												</tbody>
												<tfoot class="hide-if-no-paging">
													<tr>
														<td colspan="5">
															<div class="row">
																<div class="col-sm-4">
																	<span class="mailbox_count_msg"><b class="page_start_row">1</b>-<b class="page_end_row">20</b> of <b class="all_rows">117</b></span>
																</div>
																<div class="col-sm-8 text-right">
																	<ul class="pagination pagination-sm"></ul>
																</div>
															</div>
														</td>
													</tr>
												</tfoot>
											</table>
										</div>
										<div class="email_preview" id="mbox_preview" style="display:none">
											<div class="row">
												<div class="col-sm-12">
													<div class="mail_message_top">
														<div class="row">
															<div class="col-sm-12">
																<div class="pull-left">
																	<img src="img/user_avatar.png" alt="" class="img-thumbnail">
																</div>
																<div class="pull-left">
																	<h3 class="user_name">Lou Herzog</h3>
																	<h4 class="mail_address">kfranecki@gaylord.com</h4>
																</div>
																<div class="mail_actions">
																	<span class="mail_date">23 November 2013</span>
																	<div class="btn-group btn-group-sm">
																		<button class="btn btn-default" type="button"><span class="icon-reply"></span></button>
																		<button class="btn btn-default" type="button"><span class="icon-exclamation"></span></button>
																		<button class="btn btn-default" type="button"><span class="icon-trash"></span></button>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="mail_message_content">
														<p>Hello John</p>
														<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem atque aperiam delectus enim officiis facere molestiae eum in harum cum voluptatem blanditiis accusamus. Libero sequi assumenda doloremque molestiae nulla quod.</p>
														<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem atque aperiam delectus enim officiis facere molestiae eum in harum cum voluptatem blanditiis accusamus. Libero sequi assumenda doloremque molestiae nulla quod.</p>
														<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem atque aperiam delectus enim officiis facere molestiae eum in harum cum voluptatem blanditiis accusamus. Libero sequi assumenda doloremque molestiae nulla quod.</p>
														<div class="mail_attachment">
															<p class="sepH_c"><b>Attachments <span class="text-muted">(2 files - 320KB)</span></b></p>
															<p><span class="glyphicon glyphicon-paperclip"></span> file_01.zip <a href="#" class="btn btn-xs btn-default">Save</a></p>
															<p><span class="glyphicon glyphicon-paperclip"></span> file_02.zip <a href="#" class="btn btn-xs btn-default">Save</a></p>
														</div>
													</div>
													<div class="mail_message_footer">
														<form>
															<textarea name="mail_reply" id="mail_reply" cols="30" rows="4" class="form-control" placeholder="Start typing here to replay or forward..."></textarea>
														</form>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
	<div id="newMail" class="modal fade">
							<div class="modal-dialog">
								<div class="modal-content">
									<form>
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h4 class="modal-title" id="myModalLabel">New Message</h4>
										</div>
										<div class="modal-body">
											<div class="form-group">
												<label for="mail_to">To</label>
												<input type="text" class="form-control" name="mail_to" id="mail_to">
											</div>
											<div class="form-group">
												<label for="mail_subject">Subject</label>
												<input type="text" class="form-control" name="mail_subject" id="mail_subject">
											</div>
											<div class="form-group">
												<label for="mail_message">Message</label>
												<textarea name="mail_message" id="mail_message" cols="30" rows="6" class="form-control"></textarea>
											</div>
											<div class="form-group">
												<a href="#" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-plus"></i> Select files...</a>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-primary">Send</button>
										</div>
									</form>
								 </div>
							</div>
						</div>

