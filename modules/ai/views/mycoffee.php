<?php
  include('navbar.php');
  $days_all = array('mon' => 'Mon', 'tue' => 'Tue', 'wed' => 'Wed', 'thu' => 'Thu', 'fri' => 'Fri', 'sat' => 'Sat', 'sun' => 'Sun');
  $days_on  = explode(',', (string) $config->days);
  $zones    = DateTimeZone::listIdentifiers(DateTimeZone::PER_COUNTRY, 'US');
  $label_style = 'color:'.SN_CLR.'; margin-top: 0;';
  $linked   = trim((string) ($config->telegram_chat_id ?? '')) !== '';
  $code     = (string) ($config->telegram_link_code ?? '');
  $status_labels = array('sent' => 'Sent', 'partial' => 'Sent, some sections unavailable', 'failed' => 'Not sent', 'skipped' => 'Not sent');
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
                    <a class="btn btn-outline btn-default" href="<?= BASE_URL ?>help/guide/member/2#my-coffee-report" style="font-size: 20px;" title="Help: My Coffee Report"><i class="fa fa-question-circle"></i> Help</a>
                    <button type="submit" form="mycoffeeform" class="btn btn-outline btn-primary" style="font-size: 20px;"><i class="fa fa-save"></i> Save</button>
                    <a class="btn btn-outline btn-warning" href="<?= BASE_URL ?><?= $home_url ?>" style="font-size: 20px; color: coral;"><i class="fa fa-times-circle"></i> Close</a>
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

                <p style="color: #676a6c;">A short email each morning with <?= out(SHORTSITENAME) ?>'s bulletins and the sections you choose: membership numbers, events, posts, weather, markets, news and sports.</p>
                <?php if(!$eligible): ?>
                <p style="color: coral;"><i class="fa fa-info-circle"></i> <?= out($reason) ?> You can set it up now; it can be switched on once that's sorted.</p>
                <?php endif; ?>

                <form method="post" action="<?= BASE_URL ?>ai/mycoffeesubmit" id="mycoffeeform">
                    <input type="hidden" name="token" value="<?= $token ?>">

                    <div class="row">
                        <div class="col-md-3"><h3 style="<?= $label_style ?>">My report</h3></div>
                        <div class="col-md-9 form-group">
                            <select class="form-control" name="enabled" id="enabled" style="max-width: 220px;">
                                <option value="1"<?= $config->enabled ? ' selected' : '' ?><?= $eligible ? '' : ' disabled' ?>>On: send it</option>
                                <option value="0"<?= !$config->enabled ? ' selected' : '' ?>>Off</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3"><h3 style="<?= $label_style ?>">When</h3></div>
                        <div class="col-md-9 form-group">
                            <div style="display: flex; flex-wrap: wrap; gap: 10px; align-items: center;">
                                <input type="time" class="form-control" name="send_time" id="send_time" value="<?= out($config->send_time) ?>" style="max-width: 150px;" required aria-label="Send time">
                                <select class="form-control" name="timezone" id="timezone" style="max-width: 260px;" aria-label="Time zone">
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
                            <?= $email !== '' ? out($email) : '<span style="color: coral;">No email address on your profile.</span>' ?>
                            <br><small class="text-muted">Your profile's email address. To change it, update your profile.</small>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-3"><h3 style="<?= $label_style ?>">Sections</h3><small class="text-muted">Tick the ones you want. The numbers set their order. Bulletins always come first.</small></div>
                        <div class="col-md-9">
                        <?php include('_coffeesections.php'); ?>
                        </div>
                    </div>
                </form>

                <hr>
                <div class="row" id="telegram">
                    <div class="col-md-3"><h3 style="<?= $label_style ?>">Telegram</h3><small class="text-muted">Also get it in Telegram. Optional.</small></div>
                    <div class="col-md-9">
                        <?php if(!$bot): ?>
                            <p class="text-muted">Telegram isn't available yet.</p>
                        <?php elseif($linked): ?>
                            <label style="font-weight: normal;"><input type="checkbox" name="telegram_enabled" value="1" form="mycoffeeform"<?= !empty($config->telegram_enabled) ? ' checked' : '' ?>> Send it to my Telegram too (then click Save)</label>
                            <p class="text-muted" style="margin: 4px 0 8px;">Linked to your Telegram.</p>
                            <form method="post" action="<?= BASE_URL ?>ai/mycoffeetelegram" style="display: inline;">
                                <input type="hidden" name="token" value="<?= $token ?>"><input type="hidden" name="action" value="unlink">
                                <button type="submit" class="btn btn-outline btn-default" style="font-size: 16px;"><i class="fa fa-chain-broken"></i> Unlink Telegram</button>
                            </form>
                        <?php elseif($code !== ''): ?>
                            <ol style="padding-left: 20px;">
                                <li>Open <a href="https://t.me/<?= out($bot['username']) ?>?start=<?= out($code) ?>" target="_blank" rel="noopener">t.me/<?= out($bot['username']) ?></a> on the phone or computer where you use Telegram, and press <strong>Start</strong>.</li>
                                <li>Come back here and click <strong>I pressed Start</strong>.</li>
                            </ol>
                            <p class="text-muted" style="font-size: 14px;">Use this link: finding the bot by searching in Telegram won't link your report, because the link carries your code.</p>
                            <form method="post" action="<?= BASE_URL ?>ai/mycoffeetelegram" style="display: inline;">
                                <input type="hidden" name="token" value="<?= $token ?>"><input type="hidden" name="action" value="check">
                                <button type="submit" class="btn btn-outline btn-primary" style="font-size: 16px;"><i class="fa fa-check"></i> I pressed Start</button>
                            </form>
                            <form method="post" action="<?= BASE_URL ?>ai/mycoffeetelegram" style="display: inline;">
                                <input type="hidden" name="token" value="<?= $token ?>"><input type="hidden" name="action" value="link">
                                <button type="submit" class="btn btn-outline btn-default" style="font-size: 16px;"><i class="fa fa-refresh"></i> New link</button>
                            </form>
                        <?php else: ?>
                            <form method="post" action="<?= BASE_URL ?>ai/mycoffeetelegram" style="display: inline;">
                                <input type="hidden" name="token" value="<?= $token ?>"><input type="hidden" name="action" value="link">
                                <button type="submit" class="btn btn-outline btn-primary" style="font-size: 16px;"><i class="fa fa-send"></i> Link my Telegram</button>
                            </form>
                            <p class="text-muted" style="margin-top: 6px;">You'll get a link to <?= out(SHORTSITENAME) ?>'s Telegram bot; pressing Start there connects it to your report.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <hr>
                <div class="row" id="preview">
                    <div class="col-md-3"><h3 style="<?= $label_style ?>">Try it</h3><small class="text-muted">Uses the saved settings. Save first.</small></div>
                    <div class="col-md-9">
                        <form method="post" action="<?= BASE_URL ?>ai/mycoffeepreview" style="display: inline;">
                            <input type="hidden" name="token" value="<?= $token ?>">
                            <button type="submit" class="btn btn-outline btn-success" style="font-size: 18px;"><i class="fa fa-eye"></i> Preview</button>
                        </form>
                        <?php if($eligible): ?>
                        <form method="post" action="<?= BASE_URL ?>ai/mycoffeetest" style="display: inline;">
                            <input type="hidden" name="token" value="<?= $token ?>">
                            <button type="submit" class="btn btn-outline btn-primary" style="font-size: 18px;"><i class="fa fa-paper-plane"></i> Email it to me now</button>
                        </form>
                        <?php endif; ?>
                        <p class="text-muted" style="margin-top: 8px;">Preview shows today's report here and sends nothing. It can take up to a minute while the sections are collected.</p>
                        <?php if($preview): ?>
                        <div style="margin-top: 12px;">
                            <?= $preview['message'] ? '<p><small class="text-muted">'.out($preview['message']).'</small></p>' : '' ?>
                            <pre style="white-space: pre-wrap; font-family: inherit; font-size: 15px; background: #f8f8f8; border: 1px solid #e7eaec; padding: 14px; max-width: 760px;"><?= out($preview['text']) ?></pre>
                        </div>
                        <?php endif; ?>
                        <?php if(!empty($runs)): ?>
                        <h4 style="margin-top: 18px;">Recently sent</h4>
                        <ul style="padding-left: 20px;">
                            <?php foreach($runs as $r): ?>
                            <li><a href="<?= BASE_URL ?>ai/coffeerun/<?= (int) $r->id ?>"><?= date('D M j, g:ia', (int) $r->started_at) ?></a>:
                                <?= out($status_labels[$r->status] ?? $r->status) ?><?= $r->kind === 'test' ? ' (sent now)' : '' ?><?= $r->message ? ' <small class="text-muted">'.out($r->message).'</small>' : '' ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
