<?php
/**
* @copyright (C) 2013 iJoomla, Inc. - All rights reserved.
* @license GNU General Public License, version 2 (http://www.gnu.org/licenses/gpl-2.0.html)
* @author iJoomla.com <webmaster@ijoomla.com>
* @url https://www.jomsocial.com/license-agreement
* The PHP code portions are distributed under the GPL license. If not otherwise stated, all images, manuals, cascading style sheets, and included JavaScript *are NOT GPL, and are released under the IJOOMLA Proprietary Use License v1.0
* More info at https://www.jomsocial.com/license-agreement
*/
defined('_JEXEC') or die();
 $js = 'assets/jqueryui/drag/jquery-ui-drag.js';
 CAssets::attach($js, 'js');
?>

<div class="js-focus">
	<div class="js-focus-content">
		<div class="row-fluid">

			<div class="span3">
					<h3><?php echo $user->getDisplayName(); ?></h3>
					<img style="margin-bottom:12px" src="<?php echo $profile->largeAvatar; ?>" alt="<?php echo $this->escape( $user->getDisplayName() ); ?>" /><br>
										<!-- Send message button -->
					<?php if( !$isMine && $config->get('enablepm')){ ?>
							<a href="javascript:void(0);" class="btn" onclick="<?php echo $sendMsg; ?>">
								<span><?php echo JText::_('COM_COMMUNITY_INBOX_SEND_MESSAGE')?></span></a>
					<?php }?>
					<!-- Add as friend button -->
					<?php if( !$isMine ): ?>
						<?php if(!$isFriend && !$isMine && !$isBlocked): ?>
							<?php if(!$isWaitingApproval):?>
								<div class="btn btn-primary" onclick="joms.friends.connect('<?php echo $profile->id;?>')">
										<span><?php echo JText::_('COM_COMMUNITY_PROFILE_ADD_AS_FRIEND'); ?></span>
								</div>
							<?php else : ?>
								<div class="btn" onclick="joms.friends.connect('<?php echo $profile->id;?>')">
									<span><?php echo JText::_('COM_COMMUNITY_PROFILE_PENDING_FRIEND_REQUEST'); ?></span>
								</div>
							<?php endif ?>
						<?php endif; ?>
					<?php endif ?>
					<?php if( $isMine || COwnerHelper::isCommunityAdmin() ): ?>
						<b class="js-focus-avatar-option">
							<a href="javascript:void(0)" onclick="joms.photos.uploadAvatar('profile','<?php echo $profile->id?>')"><?php echo JText::_('COM_COMMUNITY_CHANGE_AVATAR')?></a>
						</b>
					<?php endif; ?>
			</div>
			<div class="span9" style="margin-top:32px;margin-bottom:-25px">
				<!-- Focus Menu -->
				<div class="js-focus-menu" style="margin-left:-14px">
					<div class="row-fluid">
						<div class="span12">
							<ul class="inline unstyled">
								<li><a href="#" class="about js-collapse-about-btn"><?php echo JText::_('COM_COMMUNITY_ABOUT_ME')?></a></li>
								<?php if($photoEnabled) {?>
								<li>
									<a href="<?php echo CRoute::_('index.php?option=com_community&view=photos&task=myphotos&userid='.$profile->id); ?>">
										<?php echo ($profile->_photos == 1) ? JText::sprintf('COM_COMMUNITY_PHOTOS_COUNT_SINGULAR',$profile->_photos) :  JText::sprintf('COM_COMMUNITY_PHOTOS_COUNT',$profile->_photos) ?>
									</a>
								</li>
								<?php }?>
								<?php if($videoEnabled) {?>
								<li>
									<a href="<?php echo CRoute::_('index.php?option=com_community&view=videos&task=myvideos&userid='.$profile->id); ?>">
										<?php echo ($profile->_videos == 1) ?  JText::sprintf('COM_COMMUNITY_VIDEOS_COUNT',$profile->_videos) : JText::sprintf('COM_COMMUNITY_VIDEOS_COUNT_MANY',$profile->_videos) ?>
									</a>
								</li>
								<?php }?>
								<?php if($groupEnabled) {?>
								<li>
									<a href="<?php echo CRoute::_('index.php?option=com_community&view=groups&task=mygroups&userid='.$profile->id); ?>">
										<?php echo ($profile->_groups == 1) ?  JText::sprintf('COM_COMMUNITY_GROUPS_COUNT',$profile->_groups) : JText::sprintf('COM_COMMUNITY_GROUPS_COUNT_MANY',$profile->_groups) ?>
									</a>
								</li>
								<?php }?>
								<?php if($eventEnabled) {?>
								<li>
									<a href="<?php echo CRoute::_('index.php?option=com_community&view=events&task=myevents&userid='.$profile->id); ?>">
										<?php echo ($profile->_events == 1) ? JText::sprintf('COM_COMMUNITY_EVENTS_COUNT',$profile->_events) : JText::sprintf('COM_COMMUNITY_EVENTS_COUNT_MANY',$profile->_events) ?>
									</a>
								</li>
								<?php }?>
								<li>
									<a href="<?php echo CRoute::_('index.php?option=com_community&view=friends&userid='.$profile->id); ?>">
										<?php echo ($profile->_friends == 1) ?  JText::sprintf('COM_COMMUNITY_FRIENDS_COUNT',$profile->_friends) : JText::sprintf('COM_COMMUNITY_FRIENDS_COUNT_MANY',$profile->_friends) ?>
									</a>
								</li>
								<!-- Karma -->
								<?php if($config->get('enablekarma')){ ?>
									<li class="cFocus-karma jomNameTips" title="<?php echo JText::_('COM_COMMUNITY_KARMA'); ?>"><img src="<?php echo $karmaImgUrl; ?>" alt="" /></li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
				<div class="collapse js-collapse-about">
					<div class="row-fluid">
						<div class="span12">
							<div><?php echo $about; ?></div>
							<dl class="dl-horizontal">
								<dt><?php echo JText::_('COM_COMMUNITY_MEMBER_SINCE'); ?></dt>
								<dd><?php echo JHTML::_('date', $registerDate , JText::_('DATE_FORMAT_LC2')); ?></dd>
								<dt><?php echo JText::_('COM_COMMUNITY_LAST_LOGIN'); ?></dt>
								<dd><?php echo $lastLogin; ?></dd>
								<?php if( $multiprofile->name && $config->get('profile_multiprofile') ){ ?>
									<dt><?php echo JText::_('COM_COMMUNITY_PROFILE_TYPE'); ?></dt>
									<dd><?php echo $multiprofile->name;?></dd>
								<?php } ?>
							</dl>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> <!-- end js-focus-content -->
	<div class="js-focus-actions">

		<div class="navbar">
		  <div class="navbar-inner">
		      <a class="btn btn-navbar js-collapse-btn">
		        <span class="caret"></span>
		      </a>
		      <div class="nav-collapse collapse js-collapse">
		        <ul class="nav">
					<?php if ($config->get('enablesharethis')  == 1 ) { ?>
						  <li>
							<a href="javascript:void(0);" onClick="joms.bookmarks.show('<?php echo CRoute::getExternalURL( 'index.php?option=com_community&view=profile&userid=' . $profile->id ); ?>')"><i class="js-icon-share"></i><?php echo JText::_('COM_COMMUNITY_SHARE')?></a>
						  </li>
					<?php } ?>
							<?php if($isLikeEnabled){?>
								<li id='like-profile-<?php echo $profile->id; ?>'><a href="javascript:void(0);" onclick="<?php echo ($isUserLiked > 0) ? 'joms.like.newDislike(this)' : 'joms.like.newLike(this)' ?>;" class="<?php if($isUserLiked > 0){ ?> js-focus-like <?php }?>"><i class="js-icon-thumbs-up"></i><span><?php echo $likes ?></span> <?php echo JText::_('COM_COMMUNITY_LIKE')?></a></li>
							<?php }?>
							<?php echo $reportsHTML; ?>
							<li><span><i class="js-icon-eye"></i><?php echo JText::sprintf('COM_COMMUNITY_PROFILE_VIEW_RESULT', number_format($user->getViewCount()) ) ;?></span></li>
		        </ul>
				<!-- remove checking to display Options button anyways -->
		        <ul class="nav pull-right">
		          <li class="dropup">
					<a href="#" class="js-navbar-options"><?php echo JText::_('COM_COMMUNITY_VIDEOS_OPTIONS')?></a>
		            <ul class="dropdown-menu pull-right">
						<!-- change avatar -->
		            	<?php if($isMine || COwnerHelper::isCommunityAdmin()){ ?>
		            		<li><a tabindex="-1" href="javascript:void(0)" onclick="joms.photos.uploadAvatar('profile','<?php echo $profile->id?>')"><?php echo JText::_('COM_COMMUNITY_CHANGE_AVATAR')?></a></li>
							<?php if( COwnerHelper::isCommunityAdmin() ){?>
								<!-- ban / unban -->
								<?php if( !$isMine ){?>
									<?php if(!$blocked){?>
										<li><a tabindex="-1" href="javascript:void(0);" onclick="joms.users.banUser('<?php echo $profile->id; ?>', '0' );"><?php echo JText::_('COM_COMMUNITY_BAN_USER')?></a></li>
									<?php } else {?>
										<li><a tabindex="-1" href="javascript:void(0);" onclick="joms.users.banUser('<?php echo $profile->id; ?>', '1' );"><?php echo JText::_('COM_COMMUNITY_UNBAN_USER')?></a></li>
									<?php }?>
								<?php } ?>
								<!-- stick feature -->
								<?php if ($profile->featured) { ?>
										<li><a tabindex="-1" href="javascript:void(0);" onclick="joms.featured.remove('<?php echo $profile->id;?>','search');"><?php echo JText::_('COM_COMMUNITY_REMOVE_FEATURED')?></a></li>
								<?php }else { ?>
										<li><a tabindex="-1" href="javascript:void(0);" onclick="joms.featured.add('<?php echo $profile->id;?>','search');"><?php echo JText::_('COM_COMMUNITY_MAKE_FEATURED')?></a></li>
								<?php } ?>
							<?php } ?>
							<!-- change alias: user can change their own alias -->
				          	<?php if($isSEFEnabled){?>
				          			<li><a tabindex="-1" href="javascript:void(0);" onclick="joms.users.updateURL('<?php echo $profile->id;?>');"><?php echo JText::_('COM_COMMUNITY_PROFILE_CHANGE_ALIAS');?></a></li>
				          	<?php }?>
							<!-- profile picture / cover -->
				          	<li><a tabindex="-1" href="javascript:void(0);" onclick="joms.users.removePicture('<?php echo $profile->id;?>');"><?php echo JText::_('COM_COMMUNITY_REMOVE_PROFILE_PICTURE');?></a></li>
				          	<li><a tabindex="-1" href="javascript:void(0);" onclick="joms.users.removeCover('<?php echo $profile->id;?>');"><?php echo JText::_('COM_COMMUNITY_REMOVE_PROFILE_COVER');?></a></li>
							<!-- edit preference -->
							<?php if($isMine){?>
								<li><a tabindex="-1" href="<?php echo CRoute::_('index.php?option=com_community&view=profile&task=preferences'); ?>"><?php echo JText::_('COM_COMMUNITY_EDIT_PREFERENCES');?></a></li>
								<?php if(!empty($profile->profilevideo)){?>
									<li><a tabindex="-1" href="javascript:void(0);" onClick="joms.videos.removeConfirmProfileVideo(<?php echo $profile->id?>,<?php echo $profile->profilevideo; ?>)"><?php echo JText::_('COM_COMMUNITY_VIDEOS_REMOVE_PROFILE_VIDEO');?></a></li>
								<?php }?>
							<?php }?>
			        	<?php } ?>
						<!-- block user: any none mine can do block -->
				        <?php if(!$isMine){?>
							<?php if(!$isBlocked){ ?>
								<li><a tabindex="-1" href="javascript:void(0);" onclick="joms.users.blockUser('<?php echo $profile->id;?>');"><?php echo JText::_('COM_COMMUNITY_BLOCK_USER');?></a></li>
							<?php } else {?>
								<li><a tabindex="-1" href="javascript:void(0);" onclick="joms.users.unBlockUser('<?php echo $profile->id;?>');"><?php echo JText::_('COM_COMMUNITY_UNBLOCK_USER');?></a></li>
							<?php }?>
				       	<?php } ?>
		            </ul>
		          </li>
		        </ul>

		      </div><!-- /.nav-collapse -->
		  </div><!-- /navbar-inner -->
		</div>

	</div>
</div>
