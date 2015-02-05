	<div class="box span4">
				<div class="box-header well">
					<h2>

						<i class="icon-th">
						</i>
						Dias Festivos
					</h2>
				</div>
					<!--/header-->
				<div class="box-content">
						<ul class="nav nav-tabs" id="tabs" data-tabs="tabs">
							<li class="active">
								<a href="#cumple" data-toggle="tab">
									Aniversarios y Cumpleaños
								</a>
							</li>
							<li >
								<a href="#feria" data-toggle="tab">
									Feriados
								</a>
							</li>
						</ul>
						<div id="myTabContent" class="tab-content">
							<div class="tab-pane active" id="cumple">
								<ul class="dashboard-list">
									<h3>
										Aniversarios:
									</h3>
									<?php foreach ($aniversarios as $ss): ?>
										<li>
											<div class="pull-left">
												<?php 
													echo $this->Html->link(
														$this->Html->image("/files/employee/thumb_". $ss['Employee']['image'], array('class' => 'dashboard-avatar')),
														array('controller' => 'employees', 'action' => 'view', $ss['Employee']['id']), 
														array('escape' => false)
													);
												?>
											</div>

											<div >
												
												<?php echo $this->Html->tag('strong', __('Name') . ':') ?>
												<?php 
								echo $this->Html->link(
									//$ss['Employee']['name']. ' '. $ss['Employee']['lastname'],
									$ss['Employee']['fullname'],
									array('controller' => 'employees', 'action' => 'view', $ss['Employee']['id'])
								);
							?>
												<br/>
												<?php echo $this->Html->tag('strong', __('Date') . ':') ?>
												<?php echo $this->Time->format('d-m-Y', h($ss['Employee']['entry_date'])); ?>
												<br/>
												<br/>
												<br/>
											</div>
										</li>
								<?php endforeach; ?>
								<h3>
									Cumpleaños:
								</h3>
								<?php foreach ($cumpleanos as $ss): ?>
											<li>
												<div class="pull-left">
													<?php 
														echo $this->Html->link(
															$this->Html->image("/files/employee/thumb_". $ss['Employee']['image'], array('class' => 'dashboard-avatar')),
															array('controller' => 'employees', 'action' => 'view', $ss['Employee']['id']), 
															array('escape' => false)
														);
													?>
												</div>

												<div >
													
													<?php echo $this->Html->tag('strong', __('Name') . ':') ?>
													<?php 
									echo $this->Html->link(
										//$ss['Employee']['name']. ' '. $ss['Employee']['lastname'],
										$ss['Employee']['fullname'],
										array('controller' => 'employees', 'action' => 'view', $ss['Employee']['id'])
									);
								?>
													<br/>
											<?php echo $this->Html->tag('strong', __('Date') . ':') ?>
											<?php echo $this->Time->format('d-m-Y', h($ss['Employee']['birthdate'])); ?>
												<br/>
												<br/>
												<br/>
											</div>
										</li>
								<?php endforeach; ?>
								</ul>

							</div>  <!--/cumple-->
							
							<div class="tab-pane" id="feria">
								<h3>
									Feriados:
								</h3>
								<?php foreach ($holidays as $ss): ?>
								<li>
									<?php echo $this->Html->tag('strong', __('Date') . ':') ?>
									<?php echo $this->Time->format('d-m-Y', h($ss['Holiday']['date'])); ?>
								<br/>
								
								<?php echo h($ss['Holiday']['name']); ?>
								<br/>								
							</li>
								<?php endforeach; ?>
							</div><!--/active feria-->
					</div><!--/active tabconten-->
			</div> <!--/boxconten-->
	</div><!--/span4-->
