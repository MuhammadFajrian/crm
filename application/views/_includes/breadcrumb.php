<h1 class="mt-4"><?php echo ucfirst(str_replace("-", " ", $this->uri->segments[1])); ?></h1>
<ol class="breadcrumb mb-4">
    <?php foreach ($this->uri->segments as $segment): ?>
        <?php 
            $url = substr($this->uri->uri_string, 0, strpos($this->uri->uri_string, $segment)) . $segment;
            $is_active =  $url == $this->uri->uri_string;
        ?>

        <li class="breadcrumb-item <?php echo $is_active ? 'active': '' ?>">
            <?php if($is_active): ?>
                <?php echo ucfirst(str_replace("-", " ",$segment)) ?>
            <?php else: ?>
                <a href="<?php echo site_url($url) ?>"><?php echo ucfirst(str_replace("-", " ",$segment)) ?></a>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
    <!-- <li class="breadcrumb-item active">Dashboard</li> -->
</ol>