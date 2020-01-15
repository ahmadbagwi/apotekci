			<div class="col-md-9 content"><!--mulai konten-->
				<p class="home"><a href="<?php echo base_url('Dashboard');?>"><strong> Home</strong></a> ></p>
				<div class="list_of_members">
					<div class="sales">
						<div class="icon">
						</div>
						<div class="icon-text">
							<h3><?php echo number_format($jumlah_jual); ?></h3>
							<p>Penjualan</p>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="new-users">
						<div class="icon">
							
						</div>
						<div class="icon-text">
							<h3><?php echo $jumlah_produk; ?></h3>
							<p>Produk</p>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="orders">
						<div class="icon">
							
						</div>
						<div class="icon-text">
							<h3><?php echo $jumlah_transaksi;?></h3>
							<p>Transaksi</p>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="visitors">
						<div class="icon">
							
						</div>
						<div class="icon-text">
							<h3><?php echo number_format($aset); ?></h3>
							<p>Aset</p>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="total-sales">
					<div class="user-trends col-md-12">					
							<canvas id="bar" height="340" width="780"></canvas>
								<script>
									var barChartData = {
										labels : ["January","February","March","April","May","June","July", "Agustus", "September", "Oktober", "November", "Desember"],
										datasets : [
											{
												fillColor : "rgba(255, 137, 167, 0.78)",
												strokeColor : "rgba(220,220,220,1)",
												data : [65,59,90,81,56,55,40,56,55,40,100,75]
											},

										]
										
									}

								var myLine = new Chart(document.getElementById("bar").getContext("2d")).Bar(barChartData);
								</script>
					</div>
						
					<div class="clearfix"></div>
				</div>			
				
				<div class="calenders">
					<div class="calender-left">
				
					<h3>Calendar</h3>
						<div class="column_right_grid calender">
	                      <div class="cal1"><div class="clndr"><div class="clndr-controls"><div class="clndr-control-button"><p class="clndr-previous-button">previous</p></div>
	                      <div class="month">March 2014</div><div class="clndr-control-button rightalign"><p class="clndr-next-button">next</p></div></div>
	                      <table class="clndr-table" border="0" cellspacing="0" cellpadding="0"><thead><tr class="header-days">
	                      	<td class="header-day">Sun</td><td class="header-day">Mon</td><td class="header-day">Tu</td><td class="header-day">We</td><td class="header-day">T</td>
	                      	<td class="header-day">Fr</td><td class="header-day">Su</td></tr></thead><tbody><tr><td class="day past adjacent-month last-month calendar-day-2014-02-23">
	                      	<div class="day-contents">23</div></td><td class="day past adjacent-month last-month calendar-day-2014-02-24"><div class="day-contents">24</div></td>
	                      	<td class="day past adjacent-month last-month calendar-day-2014-02-25"><div class="day-contents">25</div></td>
	                      	<td class="day past adjacent-month last-month calendar-day-2014-02-26"><div class="day-contents">26</div></td>
	                      	<td class="day past adjacent-month last-month calendar-day-2014-02-27"><div class="day-contents">27</div></td><td class="day past adjacent-month last-month calendar-day-2014-02-28"><div class="day-contents">28</div></td><td class="day past calendar-day-2014-03-01"><div class="day-contents">1</div></td></tr><tr><td class="day past calendar-day-2014-03-02"><div class="day-contents">2</div></td><td class="day past calendar-day-2014-03-03"><div class="day-contents">3</div></td><td class="day past calendar-day-2014-03-04"><div class="day-contents">4</div></td><td class="day past calendar-day-2014-03-05"><div class="day-contents">5</div></td><td class="day past calendar-day-2014-03-06"><div class="day-contents">6</div></td><td class="day past calendar-day-2014-03-07"><div class="day-contents">7</div></td><td class="day past calendar-day-2014-03-08"><div class="day-contents">8</div></td></tr><tr><td class="day past calendar-day-2014-03-09"><div class="day-contents">9</div></td><td class="day past event calendar-day-2014-03-10"><div class="day-contents">10</div></td><td class="day past event calendar-day-2014-03-11"><div class="day-contents">11</div></td><td class="day past event calendar-day-2014-03-12"><div class="day-contents">12</div></td><td class="day past event calendar-day-2014-03-13"><div class="day-contents">13</div></td><td class="day past event calendar-day-2014-03-14"><div class="day-contents">14</div></td><td class="day past calendar-day-2014-03-15"><div class="day-contents">15</div></td></tr><tr><td class="day past calendar-day-2014-03-16"><div class="day-contents">16</div></td><td class="day past calendar-day-2014-03-17"><div class="day-contents">17</div></td><td class="day past calendar-day-2014-03-18"><div class="day-contents">18</div></td><td class="day past calendar-day-2014-03-19"><div class="day-contents">19</div></td><td class="day past calendar-day-2014-03-20"><div class="day-contents">20</div></td><td class="day past event calendar-day-2014-03-21"><div class="day-contents">21</div></td><td class="day past event calendar-day-2014-03-22"><div class="day-contents">22</div></td></tr><tr><td class="day past event calendar-day-2014-03-23"><div class="day-contents">23</div></td><td class="day past calendar-day-2014-03-24"><div class="day-contents">24</div></td><td class="day today calendar-day-2014-03-25"><div class="day-contents">25</div></td><td class="day calendar-day-2014-03-26"><div class="day-contents">26</div></td><td class="day calendar-day-2014-03-27"><div class="day-contents">27</div></td><td class="day calendar-day-2014-03-28"><div class="day-contents">28</div></td><td class="day calendar-day-2014-03-29"><div class="day-contents">29</div></td></tr><tr><td class="day calendar-day-2014-03-30"><div class="day-contents">30</div></td><td class="day calendar-day-2014-03-31"><div class="day-contents">31</div></td><td class="day adjacent-month next-month calendar-day-2014-04-01"><div class="day-contents">1</div></td><td class="day adjacent-month next-month calendar-day-2014-04-02"><div class="day-contents">2</div></td><td class="day adjacent-month next-month calendar-day-2014-04-03"><div class="day-contents">3</div></td><td class="day adjacent-month next-month calendar-day-2014-04-04"><div class="day-contents">4</div></td><td class="day adjacent-month next-month calendar-day-2014-04-05"><div class="day-contents">5</div></td></tr></tbody></table></div></div>
					     </div>
					</div>
					<div class="clearfix"></div>
				</div>
				<!-- batas konten -->
				<div class="footer">
					<div class="copyright text-center">
							<p>&copy; 2019 | Powered by  <a href="https://ahmadbagwi.id">  ahmadbagwi.id</a></p>
					</div>		
				</div>
			</div><!--col-md-9-->
</body>
</html>