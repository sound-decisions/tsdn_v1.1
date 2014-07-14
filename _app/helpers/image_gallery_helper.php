<?php

/**
 * Display the issue cover gallery with no thumbnails.
 *
 * @param string $images_dir
 * @param string $div_id
 * @param string $gallery_name
 */
function display_gallery_images($images_dir, $div_id, $gallery_name) {

    // File types to display.
    $files_to_display = array('jpg', 'jpeg', 'png', 'gif');

    // Get list of files in the directory.
    $map = directory_map($images_dir);

    echo '<div id="' . $div_id . '" style="display:none;">' . chr(10);

        foreach ($map as $k => $v) {
            //echo '<p>File Name:  ' . $v . '</p>' . chr(10);

            $file_type = strtolower(end(explode('.', $v )));
            $image_title = str_replace('.' . $file_type, ' ', $v);
            //echo '<p>File Extension:  ' . $file_type . '</p>' . chr(10);

                if (in_array( $file_type, $files_to_display)) {
                    //echo '<img src="' . base_url($images_dir) . '/' . $v . '" alt="' . $v . '" />' . chr(10);
                    echo '<a href="' . base_url($images_dir) . '/' . $v . '" title="' . $image_title . '" data-gallery="' . $gallery_name . '"></a>' . chr(10);
                }

        } // end of - foreach

    echo '</div>' . chr(10);

} // end of - function display_gallery_images

/* End of file image_gallery_helper.php */
/* Location: ./application/helpers/image_gallery_helper.php */