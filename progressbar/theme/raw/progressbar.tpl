<link rel="stylesheet" type="text/css" href="{$WWWROOT}blocktype/progressbar/theme/raw/static/style/style.css">
{if $progress->value < 100}
    <div id="progress_bar_fill" style="width: {$progress->value*2}px;">&nbsp;</div>
    <p id="progress_bar">
        <span id="progress_bar_percentage">{$progress->value}%</span>
    </p>
    <div id="profile_completeness_tips">
    <br /><strong>{str tag=completiontips section=blocktype.progressbar}</strong>
    <ul>
        {if $progress->profileicon > 0}<li><a href="{$WWWROOT}artefact/file/profileicons.php">{str tag=addprofilepicture section=blocktype.progressbar}</a>&nbsp;<span class="description">(+{$progress->profileicon}%)</span></li>{/if}
        {if $progress->personalinformation > 0}<li><a href="{$WWWROOT}artefact/resume/index.php">{str tag=addpersonalinformation section=blocktype.progressbar}</a>&nbsp;<span class="description">(+{$progress->personalinformation}%)</span></li>{/if}
        {if $progress->contactinformation > 0}<li><a href="{$WWWROOT}artefact/internal/index.php?fs=contact">{str tag=addcontactinformation section=blocktype.progressbar}</a>&nbsp;<span class="description">(+{$progress->contactinformation}%)</span></li>{/if}
        {if $progress->messaging > 0}<li><a href="{$WWWROOT}artefact/internal/index.php?fs=messaging">{str tag=addmessaging section=blocktype.progressbar}</a>&nbsp;<span class="description">(+{$progress->messaging}%)</span></li>{/if}
        {if $progress->selfdescription > 0}<li><a href="{$WWWROOT}artefact/internal/index.php">{str tag=addselfdescription section=blocktype.progressbar}</a>&nbsp;<span class="description">(+{$progress->selfdescription}%)</span></li>{/if}
        {if $progress->employment > 0}<li><a href="{$WWWROOT}artefact/resume/employment.php">{str tag=addemployment section=blocktype.progressbar}</a>&nbsp;<span class="description">(+{$progress->employment}%)</span></li>{/if}
        {if $progress->achievements > 0}<li><a href="{$WWWROOT}artefact/resume/achievements.php">{str tag=addachievements section=blocktype.progressbar}</a>&nbsp;<span class="description">(+{$progress->achievements}%)</span></li>{/if}
        {if $progress->goals > 0}<li><a href="{$WWWROOT}artefact/resume/goals.php">{str tag=addgoals section=blocktype.progressbar}</a>&nbsp;<span class="description">(+{$progress->goals}%)</span></li>{/if}
        {if $progress->skills > 0}<li><a href="{$WWWROOT}artefact/resume/skills.php">{str tag=addskills section=blocktype.progressbar}</a>&nbsp;<span class="description">(+{$progress->skills}%)</span></li>{/if}
        {if $progress->interests > 0}<li><a href="{$WWWROOT}artefact/resume/interests.php">{str tag=addinterests section=blocktype.progressbar}</a>&nbsp;<span class="description">(+{$progress->interests}%)</span></li>{/if}
    </ul>
    </div>
{else}
    <div id="progress_bar_fill" style="display: none; width: {$progress->value*2}px;">&nbsp;</div>
    <p id="progress_bar_100">
        <span id="progress_bar_percentage">{$progress->value}%</span>
    </p>
{/if}
