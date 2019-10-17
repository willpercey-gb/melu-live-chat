<?php echo '&nbsp;&nbsp;&nbsp;'; ?>
<div class="melu_app_shell">
    <div class="melu_app">
        <div class="logo_container">
            <div class="logo_inner">
                <img src="<?php echo plugins_url( 'data/melu-logo.png', dirname(__FILE__ )); ?>">
            </div>
        </div>
        <br>

        <?php
        $active = '';
        if (empty($this->getOption("key"))) {
            $active = 'Melu is inactive';
        } else {
            $active = $this->verifyConnection();
        }
        ?>
        <div class="melu_active">
            <h1><?= $active; ?></h1>
        </div>
        <br>
        <?php
        if ($active !== 'Congratulations! Melu is active!'):
            ?>
            <form method="POST" action="">
                <?php settings_fields($settingsGroup); ?>
                <table class="plugin-options-table">
                    <tbody>
                    <?php
                    if ($optionMetaData != null) {
                        foreach ($optionMetaData as $aOptionKey => $aOptionMeta) {
                            $displayText = is_array($aOptionMeta) ? $aOptionMeta[0] : $aOptionMeta;
                            ?>
                            <tr valign="top">
                                <th scope="row"><p><label
                                            for="<?php echo $aOptionKey ?>"><?php echo $displayText ?></label></p>
                                </th>
                                <td>
                                    <?php $this->createFormControl($aOptionKey, $aOptionMeta, ''); ?>
                                    <p class="orange"><a href="https://meluchat.com/try-melu" target="_blank"><b>Don't have a product key?</b> Get one here and try Melu free for 30 days!</a></p>
                                    <p class="thin">Your product key is sent via email once your account is ready.</p>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>
                <p class="submit">
                    <input type="submit" class="button-primary"
                           value="<?php _e('Activate Melu', 'melu-live-chat') ?>"/>
                </p>
            </form>
        <?php else: ?>
            <form method="POST" id="deactivate_form">
                <h3 class="activation_label">Activation: </h3>
                <input class="tgl tgl-ios hidden" id="cb2" type="checkbox" checked/>
                <label class="tgl-btn" for="cb2"></label>
                <input type="hidden" name="deactivate" value="deactivate"/>
            </form>
            <?php
            if (isset($_POST['deactivate'])) {
                echo ' <div id="refresh">Deactivating....</div>';
                $this->deleteOption("key");
            }
        endif;
        ?>
    </div>
    <?php if ($active !== 'Congratulations! Melu is active!'): ?>
        <div class="row clearfix pricing-tables">
            <div class="col-md-12 col-sm-12 no-pad-right no-pad-left">
                <div class="pricing-table emphasis">
                    <div class="price">
                        <span class="sub">£</span>
                        <span class="amount">99</span>
                        <span class="sub">/mo</span>
                    </div>
                    <ul class="features">
                        <li><strong>Unlimited</strong> chats</li>
                        <li><strong>Industry standard</strong> live chat software</li>
                        <li>Professionally operated from<br><strong>8am to 10pm</strong> Monday-Friday<br>by real humans
                        </li>
                        <li><strong>No</strong> contracts</li>
                        <li><strong>No</strong> hidden fees</li>
                    </ul>
                    <a target="_blank" href="https://meluchat.com/try-melu" class="btn btn-primary btn-white">Start free
                        trial</a>
                </div>
                <label class="final_price_label">Price exclusive of VAT.</label>
            </div>
        </div>
    <?php else: ?>
        <div class="login_container">
            <!--<h1>Login to Melu</h1>-->
            <h1 class="login_txt">Login to your Melu Client Portal</h1>
            <div class="login-btn-wrap">
                <a href="https://meluchat.com/login" class="btn btn-primary btn-filled">Login</a>
            </div>
            <p class="login_label">Your client portal allows you to view chat transcripts and reports</p>
        </div>
    <?php endif; ?>
</div>
<script defer src="/wp-content/plugins/melu-live-chat/js/melu_plugin.js"></script>
