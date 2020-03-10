<?php

namespace Awakenings\Story;

class StoryForm {
    /**
    * Prepare the add/edit form variables
    *
    * @param ElggPage       $page        the page to edit
    * @param int            $parent_guid parrent page guid
    * @param ElggAnnotation $revision    revision
    *
    * @return array
    */
   public static function pages_prepare_form_vars($page = null, $parent_guid = 0, $revision = null) {
   
       // input names => defaults
       $values = [
           'title' => '',
           'description' => '',
           'access_id' => ACCESS_DEFAULT,
           'write_access_id' => ACCESS_DEFAULT,
           'tags' => '',
           'container_guid' => elgg_get_page_owner_guid(),
           'guid' => null,
           'entity' => null,
           'parent_guid' => $parent_guid,
       ];
   
       if ($page instanceof ElggPage) {
           foreach (array_keys($values) as $field) {
               if (isset($page->$field)) {
                   $values[$field] = $page->$field;
               }
           }
           
           $values['entity'] = $page;
       }
   
       if (elgg_is_sticky_form('page')) {
           $sticky_values = elgg_get_sticky_values('page');
           foreach ($sticky_values as $key => $value) {
               $values[$key] = $value;
           }
           
           elgg_clear_sticky_form('page');
       }
   
       // load the revision annotation if requested
       if ($revision instanceof ElggAnnotation && $page instanceof ElggPage && $revision->entity_guid === $page->guid) {
           $values['description'] = $revision->value;
       }
   
       return $values;
   }
}