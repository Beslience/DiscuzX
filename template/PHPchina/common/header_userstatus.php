<?php echo 'error'; exit();?>
<!--/**
 * Created by PhpStorm.
 * User: ADKi
 * Date: 2016/3/11 0011
 * Time: 9:38
 */-->
<!--{if $_G['uid']}-->
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
                        <a class="ugc_a" href="forum.php?mod=guide&view=my"><i class="fa fa-twitch twitch"></i> 帖子</a>
                    </dt>
                    <dt class="ugc_index">
                        <a class="ugc_a" href="home.php?mod=space&do=favorite&view=me"><i class="fa fa-heart heart"></i> 收藏</a>
                    </dt>
                    <dt class="ugc_index">
                        <a class="ugc_a" href="home.php?mod=space&do=friend"><i class="fa fa-users users"></i> 好友</a>
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
                    <!--{if $_G['setting']['taskon'] && !empty($_G['cookie']['taskdoing_'.$_G['uid ']])}-->
                    <dt class="profile_index">
                        <a class="profile_a" href="home.php?mod=task&item=doing" id="task_ntc" class="new"><i class="fa fa-book book"></i>{lang task_doing}</a>
                    </dt>
                    <!--{/if}-->
                    <!--用户组-->
                    <!--{if ($_G['group']['allowmanagearticle'] || $_G['group']['allowpostarticle'] || $_G['group']['allowdiy'] || getstatus($_G['member']['allowadmincp'], 4) || getstatus($_G['member']['allowadmincp'], 6) || getstatus($_G['member']['allowadmincp'], 2) || getstatus($_G['member']['allowadmincp'], 3))}-->
                    <dt class="profile_index">
                        <a class="profile_a" href="portal.php?mod=portalcp"><i class="fa fa-random random"></i><!--{if $_G['setting']['portalstatus'] }-->{lang portal_manage}<!--{else}-->{lang portal_block_manage}<!--{/if}--></a>
                    </dt>
                    <!--{/if}-->
                    <!--{if $_G['uid'] && $_G['group']['radminid'] > 1}-->
                    <dt class="profile_index">
                        <a class="profile_a" href="forum.php?mod=modcp&fid=$_G[fid]" target="_blank"><i class="fa fa-comments-o comment"></i>{lang forum_manager}</a>
                    </dt>
                    <!--{/if}-->
                    <!--{if $_G['uid'] && getstatus($_G['member']['allowadmincp'], 1)}-->
                    <dt class="profile_index">
                        <a class="profile_a" href="admin.php" target="_blank"><i class=" fa fa-wrench wrench"></i>{lang admincp}</a>
                    </dt>
                    <!--{/if}-->
                    <!--{hook/global_usernav_extra2}-->
                </dl>
            </div>
        </li>
        <li class="bell_alt">
            <div class="tx" {if $_G[member][newpm]||$_G[member][newprompt]} style="border: 2px solid #fff; background: #CC0000;"{/if}></div>
            <div class="icon">
                <i class=" fa fa-bell-o bell"></i>
            </div>
            <div class="user_index">
                <p class="bell_text">
                    <a href="home.php?mod=space&do=notice">查看所有提醒</a>
                    <a href="home.php?mod=space&do=pm">查看所有站内信</a>
                </p>
                <dl class="bell_dl">
                    <dt>
                        <i class="fa fa-bell bell_alt"></i>
                        <span class="item_title"><a href="home.php?mod=follow&do=follower"><em class="prompt_follower{if empty($_G[member][newprompt_num][follower])}_0{/if}"></em><!--{lang notice_interactive_follower}-->{if $_G[member][newprompt_num][follower]}($_G[member][newprompt_num][follower]){/if}</a></span>
                    </dt>
                    <!--{if $_G[member][newprompt] && $_G[member][newprompt_num][follow]}-->
                    <dt>
                        <i class="fa fa-bell bell_alt"></i>
                        <span class="item_title"><a href="home.php?mod=follow"><em class="prompt_concern"></em><!--{lang notice_interactive_follow}-->($_G[member][newprompt_num][follow])</a></span>
                    </dt>
                    <!--{/if}-->
                    <!--{if $_G[member][newprompt]}-->
                    <!--{loop $_G['member']['category_num'] $key $val}-->
                    <dt>
                        <i class="fa fa-bell bell_alt"></i>
                        <span class="item_title"><a href="home.php?mod=space&do=notice&view=$key"><em class="notice_$key"></em><!--{echo lang('template', 'notice_'.$key)}-->(<span class="rq">$val</span>)</a></span>
                    </dt>
                    <!--{/loop}-->
                    <!--{/if}-->
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
                    <div class="user_img"><!--{avatar($_G[uid],middle)}--></div>
                    <div class="bd_text">
                        <p><a class="user_name" href="javascript:;">{$_G[member][username]}</a></p>
                        <p class="pd">
                            <a href="home.php?mod=spacecp&ac=usergroup" class="pd_admin">{lang usergroup}: $_G[group][grouptitle]<!--{if $_G[member]['freeze']}--><span class="xi1">({lang freeze})</span><!--{/if}--></a>
                            <a href="home.php?mod=spacecp&ac=credit&showcredit=1" class="pd_admin">{lang credits}: $_G[member][credits]</a>
                        </p>
                    </div>
                    <p class="bd_last">
                        <span><i class="fa fa-cog cog"></i><a class="center" href="home.php?mod=space">个人中心</a></span>
                        <a href="member.php?mod=logging&action=logout&formhash={FORMHASH}"><i class="fa fa-sign-out signout"></i></a>
                    </p>
                </div>
            </div>
        </li>
    </ul>
</div>
<!--{else}-->
<div class="top_right" style="">
    <span class="login"><a href="member.php?mod=logging&action=login">登录</a></span>|
    <span class="register"><a href="member.php?mod=register">注册</a></span>
</div>
<!--{/if}-->
