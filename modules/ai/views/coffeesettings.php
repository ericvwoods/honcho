<?php
  include('navbar.php');
  $days_all = array('mon' => 'Mon', 'tue' => 'Tue', 'wed' => 'Wed', 'thu' => 'Thu', 'fri' => 'Fri', 'sat' => 'Sat', 'sun' => 'Sun');
  $days_on  = explode(',', (string) $config->days);
  $zones    = DateTimeZone::listIdentifiers(DateTimeZone::PER_COUNTRY, 'US');
  $label_style = 'color:'.SN_CLR.'; margin-top: 0;';
?>

<div class="row">
    <div class="col-lg-12">
        <div class="ibox-content">
            <div class="row">
                <div class="col-md-1"><img src="<?= BASE_URL ?><?= MAIN_LOGO ?>" alt="Logo"></div>
                <div class="col-md-7" style="padding-top: 18px;">
                    <span style="color:<?= CCMPS_CCMP_NAME_CLR ?>; font-size: <?= CCMPS_CCMP_FNT_SZ ?>;"><?= out($header) ?></span>
                </div>
                <div class="col-md-4" style="padding-top: 18px;">
                    <a class="btn btn-outline btn-default" href="<?= BASE_URL ?>help/guide/admin/7#step-2-set-up-the-report" style="font-size: 20px;" title="Help: setting up the report"><i class="fa fa-question-circle"></i> Help</a>
                    <button type="submit" form="coffeeform" class="btn btn-outline btn-primary" style="font-size: 20px;"><i class="fa fa-save"></i> Save</button> <!-- submits the settings form below (moved up 2026-10-29) -->
                    <a class="btn btn-outline btn-warning" href="<?= BASE_URL ?>ai/coffee" style="font-size: 20px; color: coral;"><i class="fa fa-times-circle"></i> Close</a>
                </div>
            </div>
        </div>
        <br>
        <div class="ibox">
            <div class="ibox-content" style="font-size: 16px;">

                <?php if(($_SESSION['flashmsgcolor'] ?? 0) == 1): ?>
                  <?= flashdata('<div style="font-weight: bold; font-size: 20px; color: lightseagreen;">', '</div>'); set_flashdata(''); ?>
                <?php else: ?>
                  <?= flashdata('<div style="font-weight: bold; font-size: 20px; color: crimson;">', '</div>'); set_flashdata(''); ?>
                <?php endif; ?>

                <?php if(!$ai): ?>
                <p style="color: coral;"><i class="fa fa-info-circle"></i> No AI connection for <?= out($scope_name) ?>: the report will be sent as plain facts. <a href="<?= BASE_URL ?>ai/connections">Set up AI</a></p>
                <?php endif; ?>

                <form method="post" action="<?= BASE_URL ?>ai/coffeesubmit" id="coffeeform">
                    <input type="hidden" name="token" value="<?= $token ?>">
                    <input type="hidden" name="subentity_id" value="<?= $subentity_id ?>">

                    <div class="row">
                        <div class="col-md-3"><h3 style="<?= $label_style ?>">Report</h3></div>
                        <div class="col-md-9 form-group">
                            <select class="form-control" name="enabled" id="enabled" style="max-width: 220px;">
                                <option value="1"<?= $config->enabled ? ' selected' : '' ?>>On: send it</option>
                                <option value="0"<?= !$config->enabled ? ' selected' : '' ?>>Off</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3"><h3 style="<?= $label_style ?>">When</h3></div>
                        <div class="col-md-9 form-group">
                            <div style="display: flex; flex-wrap: wrap; gap: 10px; align-items: center;">
                                <input type="time" class="form-control" name="send_time" id="send_time" value="<?= out($config->send_time) ?>" style="max-width: 150px;" required>
                                <select class="form-control" name="timezone" id="timezone" style="max-width: 260px;">
                                    <?php foreach($zones as $z): ?>
                                    <option value="<?= $z ?>"<?= $z === $config->timezone ? ' selected' : '' ?>><?= out(str_replace('_', ' ', $z)) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div style="margin-top: 10px;">
                                <?php foreach($days_all as $d => $label): ?>
                                <label style="margin-right: 14px; font-weight: normal;"><input type="checkbox" name="days[]" value="<?= $d ?>"<?= in_array($d, $days_on, true) ? ' checked' : '' ?>> <?= $label ?></label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3"><h3 style="<?= $label_style ?>">Sent to</h3></div>
                        <div class="col-md-9 form-group">
                            <label style="font-weight: normal;"><input type="checkbox" name="send_to_admins" value="1"<?= $config->send_to_admins ? ' checked' : '' ?>>
                                Send it to <?= out($scope_name) ?>'s admins (<?= $subentity_id === 0 ? 'System and '.CCMP.' Admins' : SUBENTITY.' Admins' ?>)</label>
                            <?php
                              $with    = array_filter($admin_list, function($a){ return $a['email'] !== ''; });
                              $without = array_filter($admin_list, function($a){ return $a['email'] === ''; });
                            ?>
                            <div class="text-muted" style="font-size: 14px; margin: -4px 0 8px 20px;">
                                <?= $with ? 'That is: '.out(implode(', ', array_map(function($a){ return $a['name'].' ('.$a['email'].')'; }, $with))).'.' : 'No admin has an email address yet.' ?>
                                <?= $without ? '<br>Not included, no email address on their record: '.out(implode(', ', array_column($without, 'name'))).'.' : '' ?>
                            </div>
                            <label for="extra_recipients" style="display: block; margin-top: 6px;">Also send it to these addresses <span class="text-muted" style="font-weight: normal;">(always, whether or not the box above is ticked)</span></label>
                            <textarea class="form-control" name="extra_recipients" id="extra_recipients" rows="3" placeholder="One email address per line"><?= out((string) $config->extra_recipients) ?></textarea>
                            <small class="text-muted">For anyone else who should get it, such as board members without an admin role. One address per line; each person gets their own copy.</small>
                        </div>
                    </div>

                    <div class="row" id="telegram">
                        <div class="col-md-3"><h3 style="<?= $label_style ?>">Telegram</h3><small class="text-muted">Also send it to a Telegram chat. Optional.</small></div>
                        <div class="col-md-9 form-group">
                            <label style="font-weight: normal;"><input type="checkbox" name="telegram_enabled" value="1"<?= !empty($config->telegram_enabled) ? ' checked' : '' ?>> Send to Telegram too</label>
                            <div style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 6px;">
                                <div style="flex: 1 1 320px; min-width: 0;">
                                    <label for="telegram_token" style="font-weight: normal; font-size: 15px;">Bot token</label>
                                    <input type="password" class="form-control" name="telegram_token" id="telegram_token" autocomplete="new-password" spellcheck="false"
                                           placeholder="<?= !empty($config->telegram_token_enc) ? 'Saved (ends in '.out((string) $config->telegram_token_hint).'). Leave blank to keep it.' : 'From @BotFather, e.g. 123456789:ABC...' ?>">
                                </div>
                                <div style="flex: 0 1 240px;">
                                    <label for="telegram_chat_id" style="font-weight: normal; font-size: 15px;">Chat ID</label>
                                    <input type="text" class="form-control" name="telegram_chat_id" id="telegram_chat_id" value="<?= out((string) ($config->telegram_chat_id ?? '')) ?>" placeholder="e.g. 123456789 or -100...">
                                </div>
                            </div>
                            <?php if(!empty($config->telegram_token_enc)): ?>
                            <label style="font-weight: normal; margin-top: 6px;"><input type="checkbox" name="telegram_remove" value="1"> Remove the saved bot token</label><br>
                            <?php endif; ?>
                            <small class="text-muted">Make a bot with <strong>@BotFather</strong> in Telegram and paste its token. Then message the bot (or add it to your admins' group and post there) and use <strong>Find chat ID</strong> below. The token is stored encrypted.</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3"><h3 style="<?= $label_style ?>">Email subject</h3></div>
                        <div class="col-md-9 form-group"><input type="text" class="form-control" name="subject" id="subject" maxlength="150" value="<?= out((string) $config->subject) ?>" required></div>
                    </div>

                    <div class="row">
                        <div class="col-md-3"><h3 style="<?= $label_style ?>">Tone</h3></div>
                        <div class="col-md-9 form-group">
                            <input type="text" class="form-control" name="tone" id="tone" maxlength="500" value="<?= out((string) $config->tone) ?>">
                            <small class="text-muted">How the AI should write it. It never changes the facts.</small>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-3"><h3 style="<?= $label_style ?>">Sections</h3><small class="text-muted">Tick the ones to include. The numbers set their order.</small></div>
                        <div class="col-md-9">
                        <?php include('_coffeesections.php'); ?>
                        </div>
                    </div>

                    
                </form>

                <hr>
                <div class="row" id="preview">
                    <div class="col-md-3"><h3 style="<?= $label_style ?>">Try it</h3><small class="text-muted">Uses the saved settings. Save first.</small></div>
                    <div class="col-md-9">
                        <form method="post" action="<?= BASE_URL ?>ai/coffeepreview" style="display: inline;">
                            <input type="hidden" name="token" value="<?= $token ?>"><input type="hidden" name="subentity_id" value="<?= $subentity_id ?>">
                            <button type="submit" class="btn btn-outline btn-success" style="font-size: 18px;"><i class="fa fa-eye"></i> Preview</button>
                        </form>
                        <form method="post" action="<?= BASE_URL ?>ai/coffeetest" style="display: inline;">
                            <input type="hidden" name="token" value="<?= $token ?>"><input type="hidden" name="subentity_id" value="<?= $subentity_id ?>">
                            <?php $list_count = count($list_recipients); ?>
                            <select class="form-control" name="test_to" id="test_to" aria-label="Send the test to" style="display: inline-block; width: auto; height: 38px; font-size: 16px; vertical-align: middle;">
                                <option value="me"<?= $my_email !== '' ? ' selected' : ' disabled' ?>>To me<?= $my_email !== '' ? ' ('.out($my_email).')' : ' (your account has no email)' ?></option>
                                <option value="list"<?= $my_email === '' ? ' selected' : '' ?>>To everyone on the "Sent to" list (<?= (int) $list_count ?>)</option>
                            </select>
                            <button type="submit" class="btn btn-outline btn-primary" style="font-size: 18px;"><i class="fa fa-paper-plane"></i> Send a test</button>
                        </form>
                        <p class="text-muted" style="margin: 6px 0 0; font-size: 14px;">The "Sent to" list (<?= (int) $list_count ?>, each address once): <?= $list_count ? out(implode(', ', $list_recipients)) : 'nobody yet' ?></p>
                        <?php if(!empty($config->telegram_token_enc)): ?>
                        <form method="post" action="<?= BASE_URL ?>ai/coffeetelegramtest" style="display: inline;">
                            <input type="hidden" name="token" value="<?= $token ?>"><input type="hidden" name="subentity_id" value="<?= $subentity_id ?>">
                            <button type="submit" class="btn btn-outline btn-primary" style="font-size: 18px;"><i class="fa fa-send"></i> Telegram test</button>
                        </form>
                        <form method="post" action="<?= BASE_URL ?>ai/coffeetelegramchats" style="display: inline;">
                            <input type="hidden" name="token" value="<?= $token ?>"><input type="hidden" name="subentity_id" value="<?= $subentity_id ?>">
                            <button type="submit" class="btn btn-outline btn-default" style="font-size: 18px;"><i class="fa fa-search"></i> Find chat ID</button>
                        </form>
                        <?php endif; ?>
                        <p class="text-muted" style="margin-top: 8px;">Preview shows today's report here and sends nothing. Send a test emails it to you, or to everyone on the "Sent to" list as a dry run of the real thing; Telegram test sends it to the Telegram chat. Both take up to a minute while the sections are collected<?= $ai ? ' and the AI writes it up' : '' ?>.</p>
                        <?php if($preview): ?>
                        <div style="margin-top: 12px;">
                            <p><strong><?= $preview['ai'] ? 'Written by the AI' : 'Plain report (no AI)' ?></strong><?= $preview['message'] ? '<br><small class="text-muted">'.out($preview['message']).'</small>' : '' ?></p>
                            <pre style="white-space: pre-wrap; font-family: inherit; font-size: 15px; background: #f8f8f8; border: 1px solid #e7eaec; padding: 14px; max-width: 760px;"><?= out($preview['text']) ?></pre>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
