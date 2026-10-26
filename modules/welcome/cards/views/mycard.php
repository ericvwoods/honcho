<?php
  include('navbar.php');
  // $details (card_helper card_details()), $code (the QR text), $card, $admin_view, $token, $card_bg, $card_accent
?>

<style>
  .member-card { width: 100%; max-width: 420px; border-radius: 16px; color: #fff; padding: 20px 22px; box-shadow: 0 10px 28px rgba(0,0,0,.25);
                 background: <?= out($card_bg) ?>; font-family: 'Open Sans', helvetica, arial, sans-serif; }
  .member-card .mc-top { display: flex; justify-content: space-between; align-items: center; gap: 10px; font-size: 12px; letter-spacing: 2px; text-transform: uppercase; opacity: .9; }
  .member-card .mc-top img { height: 34px; border-radius: 4px; background: #fff; padding: 2px; }
  .member-card .mc-who { display: flex; gap: 14px; align-items: center; margin: 16px 0 14px; }
  .member-card .mc-photo { width: 72px; height: 72px; border-radius: 50%; object-fit: cover; border: 3px solid <?= out($card_accent) ?>; background: rgba(255,255,255,.15);
                           display: flex; align-items: center; justify-content: center; font-size: 26px; font-weight: bold; flex: none; }
  .member-card .mc-name { font-size: 22px; font-weight: bold; line-height: 1.2; }
  .member-card .mc-line { font-size: 14px; opacity: .92; line-height: 1.5; }
  .member-card .mc-qr { background: #fff; border-radius: 10px; padding: 10px; display: flex; justify-content: center; }
  .member-card .mc-qr svg { width: 100%; max-width: 240px; height: auto; display: block; }
  .member-card .mc-foot { display: flex; justify-content: space-between; margin-top: 12px; font-size: 13px; letter-spacing: 1px; text-transform: uppercase; }
  .member-card .mc-foot b { color: #fff; border-bottom: 3px solid <?= out($card_accent) ?>; }
</style>

<div class="row">
    <div class="col-lg-12">
        <div class="ibox-content">

            <?php if(($_SESSION['flashmsgcolor'] ?? 0) == 1): ?>
              <?= flashdata('<div style="font-weight: bold; font-size: 20px; color: lightseagreen;">', '</div>');
              $flash_msg = '';
              set_flashdata($flash_msg); ?>
            <?php else: ?>
              <?= flashdata('<div style="font-weight: bold; font-size: 20px; color: crimson;">', '</div>');
              $flash_msg = '';
              set_flashdata($flash_msg); ?>
            <?php endif; ?>

            <div class="row">
                <div class="col-md-5">
                    <div class="member-card" id="member-card">
                        <div class="mc-top">
                            <img src="<?= BASE_URL ?><?= MAIN_LOGO ?>" alt="">
                            <span><?= out($details->org_name) ?></span>
                        </div>
                        <div class="mc-who">
                            <?php if($details->photo_url != ''): ?>
                                <img class="mc-photo" src="<?= out($details->photo_url) ?>" alt="">
                            <?php else: ?>
                                <div class="mc-photo"><?= out($details->initials) ?></div>
                            <?php endif; ?>
                            <div>
                                <div class="mc-name"><?= out($details->name) ?></div>
                                <div class="mc-line"><?= out($details->member_word) ?> No. <?= out($details->member_number) ?></div>
                                <div class="mc-line"><?= out($details->chapter) ?></div>
                                <div class="mc-line"><?= out($details->member_type) ?></div>
                            </div>
                        </div>
                        <div class="mc-qr" id="card-qr" aria-label="Card QR code"></div>
                        <div class="mc-foot">
                            <span>Valid through</span>
                            <b><?= out($details->valid_through) ?></b>
                        </div>
                    </div>
                </div>

                <div class="col-md-7" style="font-size: 16px; padding-top: 10px;">
                    <h2 style="color: <?= SN_CLR ?>;"><?= $admin_view ? 'About this card' : 'Your '.out(strtolower(CCMP)).' card' ?></h2>
                    <p>Show the QR code at the door of <?= out($details->org_short) ?> events and meetings. The volunteer scans it and the system checks, at that moment, that the membership is current.</p>
                    <p>The code doesn't contain any personal information. On its own it means nothing; only <?= out($details->org_short) ?>'s check-in page can read it.</p>
                    <p class="text-muted" style="font-size: 14px;">Card issued <?= date('F j, Y', (int) $card->issued_at) ?>. Coming soon: <strong>Add to Google Wallet</strong>.</p>

                    <h3 style="color: <?= SN_CLR ?>; margin-top: 24px;"><?= $admin_view ? 'Lost or misused?' : 'Lost your phone?' ?></h3>
                    <p><?= $admin_view ? 'Cancelling the card stops the old QR code working at once and issues a new one.' : 'Cancel this card and get a new one. The old QR code stops working at once, wherever it is.' ?></p>
                    <form method="post" action="<?= BASE_URL ?>welcome-cards/reissue" id="reissue-form">
                        <input type="hidden" name="token" value="<?= $token ?>">
                        <input type="hidden" name="ccmp_id" value="<?= (int) $details->ccmp_id ?>">
                        <label style="font-weight: normal;"><input type="checkbox" id="reissue-sure" required> I understand the old card stops working</label><br>
                        <button class="btn btn-outline btn-danger" type="submit" style="font-size: 16px; margin-top: 6px;"><i class="fa fa-refresh"></i> Cancel and issue a new card</button>
                    </form>

                    <br>
                    <a class="btn btn-outline btn-warning" href="<?= BASE_URL ?><?= $home_url ?>" style="font-size: 16px; color: coral;"><i class="fa fa-times-circle"></i> Close</a>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="<?= BASE_URL ?>js/qrcode-generator-1.4.4/qrcode.js"></script>
<script>
  (function () {
    var qr = qrcode(0, 'M'); // size picked automatically; M = 15% error correction, survives a scratched screen
    qr.addData(<?= json_encode($code) ?>);
    qr.make();
    document.getElementById('card-qr').innerHTML = qr.createSvgTag({ cellSize: 6, margin: 2, scalable: true });
  })();
</script>
