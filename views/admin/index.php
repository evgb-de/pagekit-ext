<?php $view->script('pkddl', 'pkddl:js/admin.js', 'vue') ?>
<script type="text/javascript" src="/app/assets/uikit/js/components/datepicker.min.js"></script>
<script type="text/javascript" src="/app/assets/uikit/js/components/biblepicker.js"></script>
<div id="pkddl-table" class="uk-form">
  <button class="uk-button uk-button-primary uk-align-right" @click="save">{{ 'Save' | trans }}</button>

  <h2>{{ '{0} DDLs|one: One DDL|more: %count% DDLs' | transChoice entries.length {count:entries.length} }}</h2>

  <form class="uk-width-large-1-1 uk-form" @submit="add">
    <input class="uk-input-large uk-width-1-6"  v-bind:class="{ 'uk-form-danger': isPreacherDanger }" placeholder="{{ 'Preacher' | trans }}" v-model="newPreacher">
    <input class="uk-input-large uk-width-1-6"  v-bind:class="{ 'uk-form-danger': isBiblepassageDanger }" placeholder="{{ 'Bible passage' | trans }}" type="text" data-uk-biblepicker="{format:'DD.MM.YYYY'}" v-model="newBiblepassage">
    <input class="uk-input-large uk-width-1-6"  v-bind:class="{ 'uk-form-danger': isDescriptionDanger }" placeholder="{{ 'Description' | trans }}" v-model="newDescription">
    <input class="uk-input-large uk-width-1-6"  v-bind:class="{ 'uk-form-danger': isDateDanger }" placeholder="{{ 'Date' | trans }}" type="text" data-uk-datepicker="{format:'DD.MM.YYYY'}" v-model="newDate">
    <input class="uk-input-large uk-width-1-6"  v-bind:class="{ 'uk-form-danger': isFileDanger }" placeholder="{{ 'File' | trans }}" type="text" v-model="newFile">
    <button class="uk-button" @click="add">{{ 'Add' | trans }}</button>

  </form>
  <panel-finder :root="storage" v-model="finder" :modal="true"></panel-finder>

<div class="uk-modal-footer uk-text-right">
    <button class="uk-button uk-button-link uk-modal-close" type="button">{{ 'Cancel' | trans }}</button>
    <button class="uk-button uk-button-primary" type="button" :disabled="!hasSelection()" @click.prevent="select">{{ 'Select' | trans }}</button>
</div>


  <div class="uk-alert" v-if="!entries.length">{{ 'You can add your first Entry using the input fields above. Go ahead!' | trans }}</div>
  <div class="uk-overflow-container uk-width-1-1">
    <table class="uk-table-striped uk-table-hover uk-width-1-1" v-if="entries.length">
      <thead>
        <tr>
          <th class="uk-width-1-8">{{ 'Preacher' | trans }}</th>
          <th class="uk-width-1-8">{{ 'Bible passage' | trans }}</th>
          <th class="uk-width-1-8">{{ 'Description' | trans }}</th>
          <th class="uk-width-1-8">{{ 'Date' | trans }}</th>
          <th class="uk-width-2-8">{{ 'Files' | trans }}</th>
          <th class="uk-width-2-8">{{ 'Actions' | trans }}</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="entry in entries" :class="{'uk-text-muted': entry.hidden}">
          <td class="uk-width-1-10 uk-text-center">{{ entry.preacher }}</td>
          <td class="uk-width-1-10 uk-text-center">{{ entry.biblepassage }}</td>
          <td class="uk-width-1-10 uk-text-center">{{ entry.description }}</td>
          <td class="uk-width-2-10 uk-text-center">{{ entry.date }}</td>
          <td class="uk-width-2-10 uk-text-right">
            <div class="uk-button-group">
              <a v-for="link in entry.links" class="uk-button uk-button-mini" href="{{ link.link }}">{{ link.description | trans }}</a>
            </div>
          </td>
          <td class="uk-width-2-10 uk-text-right">
            <input class="uk-input-mini" placeholder="{{ 'Description' | trans }}" v-model="newLinkDescription" v-if="entry.hiddenLink">
            <input class="uk-input-mini" placeholder="{{ 'Link' | trans }}" v-model="newLink" v-if="entry.hiddenLink">
            <div class="uk-button-group">
              <button @click="toggleLink(entry)"  class="uk-button uk-button-mini uk-width-1-2"><i :class="{'uk-icon-plus': !entry.hiddenLink, 'uk-icon-minus': entry.hiddenLink}"></i></button>
              <button @click="addLink(entry)"     class="uk-button uk-button-mini uk-width-1-2" v-if="entry.hiddenLink"><i class="uk-icon-check"></i></button>
            </div>
            <div class="uk-button-group">
              <button @click="toggle(entry)"  class="uk-button uk-button-mini">{{ entry.hidden ? "Unhide" : "Hide" | trans }}</button>
              <button @click="edit(entry)"    class="uk-button uk-button-mini"><i class="uk-icon-pencil"></i></button>
              <button @click="remove(entry)"  class="uk-button uk-button-mini uk-button-danger" v-if="entry.hidden"><i class="uk-icon-remove"></i></button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
