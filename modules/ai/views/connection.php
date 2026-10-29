<?php
  include('navbar.php');

  $provider = $conn->provider ?? 'anthropic';
  $model    = $conn->model ?? 'claude-opus-5-5';
  $has_key  = $conn && !empty($conn->credential_enc);
?>

<div class="row"> <!-- Page Row One -->
    <div class="col-lg-12">
        <div class="ibox-content">
            <div class="row">
                <div class="col-md-1">
                    <img src="<?= BASE_URL ?><?= MAIN_LOGO ?>" alt="Logo">
                </div>
                <div class="col-md-7" style="padding-top: 18px;">
                    <span style="color:<?= CCMPS_CCMP_NAME_CLR ?>; font-size: <?= CCMPS_CCMP_FNT_SZ ?>;"><?= out($header) ?></span>
                </div>
                <div class="col-md-4" style="padding-top: 18px;">
                    <a class="btn btn-outline btn-warning" href="<?= BASE_URL ?>ai/connections" style="font-size: 20px; color: coral;"><i class="fa fa-times-circle"></i> Close</a>
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

                <form method="post" action="<?= BASE_URL ?>ai/connectionsubmit" autocomplete="off">
                    <input type="hidden" name="token" value="<?= $token ?>">
                    <input type="hidden" name="subentity_id" value="<?= $subentity_id ?>">

                    <div class="row">
                        <div class="col-md-3"><label for="provider"><h3 style="color:<?= SN_CLR ?>;">AI provider</h3></label></div>
                        <div class="col-md-6 form-group">
                            <select class="form-control" id="provider" name="provider">
                                <?php foreach($providers as $code => $p): ?>
                                <option value="<?= $code ?>"<?= $code === $provider ? ' selected' : '' ?><?= $p['available'] ? '' : ' disabled' ?>><?= out($p['label']) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <small class="text-muted">A Claude Pro, Max or Team <strong>subscription</strong> can't be used here: Anthropic allows those logins only in Claude.ai and Claude Code. Use an API key from <strong>console.anthropic.com</strong> (API keys).</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3"><label for="model"><h3 style="color:<?= SN_CLR ?>;">Model</h3></label></div>
                        <div class="col-md-6 form-group">
                            <select class="form-control" id="model" name="model">
                                <?php foreach($providers['anthropic']['models'] as $code => $label): ?>
                                <option value="<?= $code ?>"<?= $code === $model ? ' selected' : '' ?>><?= out($label) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <small class="text-muted">Opus is the most capable; Sonnet and Haiku cost less. Start with Opus and change it later if the cost matters more.</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3"><label for="api_key"><h3 style="color:<?= SN_CLR ?>;">API key</h3></label></div>
                        <div class="col-md-6 form-group">
                            <input type="password" class="form-control" id="api_key" name="api_key" autocomplete="new-password" spellcheck="false"
                                   placeholder="<?= $has_key ? 'Saved (ends in '.out($conn->credential_hint).'). Leave blank to keep it.' : 'Paste the API key' ?>">
                            <small class="text-muted">Stored encrypted. It's never shown again; only its last 4 characters are kept to recognize it.</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3"><label for="enabled"><h3 style="color:<?= SN_CLR ?>;">Connection</h3></label></div>
                        <div class="col-md-6 form-group">
                            <select class="form-control" id="enabled" name="enabled" style="max-width: 200px;">
                                <option value="1"<?= !$conn || $conn->enabled ? ' selected' : '' ?>>On</option>
                                <option value="0"<?= $conn && !$conn->enabled ? ' selected' : '' ?>>Off</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3"><label for="monthly_limit"><h3 style="color:<?= SN_CLR ?>;">Monthly limit ($)</h3></label></div>
                        <div class="col-md-6 form-group">
                            <input type="number" class="form-control" id="monthly_limit" name="monthly_limit" style="max-width: 200px;" min="0" step="1"
                                   value="<?= $conn ? out(number_format((float) $conn->monthly_limit, 0, '.', '')) : '25' ?>" required>
                            <small class="text-muted">When this month's estimated cost reaches it, the AI pauses until next month. 0 = no limit. Also set a spend limit in the provider's console as a backstop.</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-outline btn-primary" style="font-size: 18px;"><i class="fa fa-save"></i> Save</button>
                        </div>
                    </div>
                </form>

                <?php if($has_key): ?>
                <hr>
                <div class="row">
                    <div class="col-md-3"><h3 style="color:<?= SN_CLR ?>;">Check it</h3></div>
                    <div class="col-md-9">
                        <?php if($conn->last_test_at): ?>
                        <p>Last test <?= date('M j, Y g:ia', (int) $conn->last_test_at) ?>:
                           <strong style="color: <?= $conn->last_test_ok ? SN_CLR : 'crimson' ?>;"><?= out($conn->last_test_msg) ?></strong></p>
                        <?php endif; ?>
                        <form method="post" action="<?= BASE_URL ?>ai/testconnection" style="display: inline;">
                            <input type="hidden" name="token" value="<?= $token ?>">
                            <input type="hidden" name="subentity_id" value="<?= $subentity_id ?>">
                            <button type="submit" class="btn btn-outline btn-success" style="font-size: 18px;"><i class="fa fa-plug"></i> Test connection</button>
                        </form>
                        <form method="post" action="<?= BASE_URL ?>ai/removekey" style="display: inline;" id="removekeyform">
                            <input type="hidden" name="token" value="<?= $token ?>">
                            <input type="hidden" name="subentity_id" value="<?= $subentity_id ?>">
                            <button type="submit" class="btn btn-outline btn-danger" style="font-size: 18px;" id="removekeybtn"><i class="fa fa-trash"></i> Remove key</button>
                        </form>
                        <p id="removekeyconfirm" class="text-danger" style="display: none; margin-top: 8px;">Click Remove key again to delete the key and switch the connection off.</p>
                        <p class="text-muted" style="margin-top: 8px;">The test sends one very short question to the AI; it costs a fraction of a cent.</p>
                    </div>
                </div>
                <script>
                  (function(){ // a second click confirms, so a stray click can't remove the key
                    var armed = false;
                    document.getElementById('removekeyform').addEventListener('submit', function(e){
                      if(!armed){ e.preventDefault(); armed = true; document.getElementById('removekeyconfirm').style.display = 'block'; }
                    });
                  })();
                </script>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>
