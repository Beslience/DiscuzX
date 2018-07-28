<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<!--/**
 * Created by PhpStorm.
 * User: ADKi
 * Date: 2016/3/11 0011
 * Time: 9:38
 */-->
<?php if($_G['uid']) { ?>
<div class="login_wrap">
    <ul>
        <li class="ugc">
            <div class="tx"></div>
            <div class="icon">
                <i class="fa fa-sitemap sitemap"></i>
            </div>
            <div class="user_index">
                <dl class="ugc_ul">
                    <dt class="ugc_index">
                        <a class="ugc_a" href="forum.php?mod=guide&amp;view=my"><i class="fa fa-twitch twitch"></i> 帖子</a>
                    </dt>
                    <dt class="ugc_index">
                        <a class="ugc_a" href="home.php?mod=space&amp;do=favorite&amp;view=me"><i class="fa fa-heart heart"></i> 收藏</a>
                    </dt>
                    <dt class="ugc_index">
                        <a class="ugc_a" href="home.php?mod=space&amp;do=friend"><i class="fa fa-users users"></i> 好友</a>
                    </dt>
                </dl>
            </div>
        </li>
        <li class="profile">
            <div class="tx"></div>
            <div class="icon">
                <i class="fa fa-cogs cogs"></i>
            </div>
            <div class="user_index">
                <dl class="profile_ul">
                    <dt class="profile_index">
                        <a class="profile_a" href="home.php?mod=spacecp"><i class="fa fa-cog cog"></i> 设置</a>
                    </dt>
                    <?php if($_G['setting']['taskon'] && !empty($_G['cookie']['taskdoing_'.$_G['uid ']])) { ?>
                    <dt class="profile_index">
                        <a class="profile_a" href="home.php?mod=task&amp;item=doing" id="task_ntc" class="new"><i class="fa fa-book book"></i>进行中的任务</a>
                    </dt>
                    <?php } ?>
                    <!--用户组-->
                    <?php if(($_G['group']['allowmanagearticle'] || $_G['group']['allowpostarticle'] || $_G['group']['allowdiy'] || getstatus($_G['member']['allowadmincp'], 4) || getstatus($_G['member']['allowadmincp'], 6) || getstatus($_G['member']['allowadmincp'], 2) || getstatus($_G['member']['allowadmincp'], 3))) { ?>
                    <dt class="profile_index">
                        <a class="profile_a" href="portal.php?mod=portalcp"><i class="fa fa-random random"></i><?php if($_G['setting']['portalstatus'] ) { ?>门户管理<?php } else { ?>模块管理<?php } ?></a>
                    </dt>
                    <?php } ?>
                    <?php if($_G['uid'] && $_G['group']['radminid'] > 1) { ?>
                    <dt class="profile_index">
                        <a class="profile_a" href="forum.php?mod=modcp&amp;fid=<?php echo $_G['fid'];?>" target="_blank"><i class="fa fa-comments-o comment"></i><?php echo $_G['setting']['navs']['2']['navname'];?>管理</a>
                    </dt>
                    <?php } ?>
                    <?php if($_G['uid'] && getstatus($_G['member']['allowadmincp'], 1)) { ?>
                    <dt class="profile_index">
                        <a class="profile_a" href="admin.php" target="_blank"><i class=" fa fa-wrench wrench"></i>管理中心</a>
                    </dt>
                    <?php } ?>
                    <?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra2'])) echo $_G['setting']['pluginhooks']['global_usernav_extra2'];?>
                </dl>
            </div>
        </li>
        <li class="bell_alt">
            <div class="tx" <?php if($_G['member']['newpm']||$_G['member']['newprompt']) { ?> style="border: 2px solid #fff; background: #CC0000;"<?php } ?>></div>
            <div class="icon">
                <i class=" fa fa-bell-o bell"></i>
            </div>
            <div class="user_index">
                <p class="bell_text">
                    <a href="home.php?mod=space&amp;do=notice">查看所有提醒</a>
                    <a href="home.php?mod=space&amp;do=pm">查看所有站内信</a>
                </p>
                <dl class="bell_dl">
                    <dt>
                        <i class="fa fa-bell bell_alt"></i>
                        <span class="item_title"><a href="home.php?mod=follow&amp;do=follower"><em class="prompt_follower<?php if(empty($_G['member']['newprompt_num']['follower'])) { ?>_0<?php } ?>"></em>新听众<?php if($_G['member']['newprompt_num']['follower']) { ?>(<?php echo $_G['member']['newprompt_num']['follower'];?>)<?php } ?></a></span>
                    </dt>
                    <?php if($_G['member']['newprompt'] && $_G['member']['newprompt_num']['follow']) { ?>
                    <dt>
                        <i class="fa fa-bell bell_alt"></i>
                        <span class="item_title"><a href="home.php?mod=follow"><em class="prompt_concern"></em>我关注的(<?php echo $_G['member']['newprompt_num']['follow'];?>)</a></span>
                    </dt>
                    <?php } ?>
                    <?php if($_G['member']['newprompt']) { ?>
                    <?php if(is_array($_G['member']['category_num'])) foreach($_G['member']['category_num'] as $key => $val) { ?>                    <dt>
                        <i class="fa fa-bell bell_alt"></i>
                        <span class="item_title"><a href="home.php?mod=space&amp;do=notice&amp;view=<?php echo $key;?>"><em class="notice_<?php echo $key;?>"></em><?php echo lang('template', 'notice_'.$key); ?>(<span class="rq"><?php echo $val;?></span>)</a></span>
                    </dt>
                    <?php } ?>
                    <?php } ?>
                </dl>
            </div>
        </li>
        <li class="notify">
            <div class="tx"></div>
            <div class="icon">
                <i class="fa fa-user-secret home"></i>
            </div>
            <div class="user_index">
                <div class="bd">
                    <div class="user_img"><?php echo avatar($_G[uid],middle);?></div>
                    <div class="bd_text">
                        <p><a class="user_name" href="javascript:;"><?php echo $_G['member']['username'];?></a></p>
                        <p class="pd">
                            <a href="home.php?mod=spacecp&amp;ac=usergroup" class="pd_admin">用户组: <?php echo $_G['group']['grouptitle'];?><?php if($_G['member']['freeze']) { ?><span class="xi1">(已冻结)</span><?php } ?></a>
                            <a href="home.php?mod=spacecp&amp;ac=credit&amp;showcredit=1" class="pd_admin">积分: <?php echo $_G['member']['credits'];?></a>
                        </p>
                    </div>
                    <p class="bd_last">
                        <span><i class="fa fa-cog cog"></i><a class="center" href="home.php?mod=space">个人中心</a></span>
                        <a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>"><i class="fa fa-sign-out signout"></i></a>
                    </p>
                </div>
            </div>
        </li>
    </ul>
</div>
<?php } else { ?>
<div class="top_right" style="">
    <span class="login"><a href="member.php?mod=logging&amp;action=login">登录</a></span>|
    <span class="register"><a href="member.php?mod=register">注册</a></span>
</div>
<?php } ?>
