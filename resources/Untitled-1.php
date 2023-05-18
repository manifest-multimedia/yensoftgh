
<!-- Button to trigger the modal -->
<button class="text-btn" id="compose-btn">Compose</button>
    <!-- Modal HTML -->
<div id="newMessageModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>New Message</h2>
    <form>
        <div class="fields">
            <div class="card-input">
                <label for="to">To:</label>
                <input type="text" id="to" name="to" placeholder="Enter recipients separated by commas">
                <br>
                <label for="subject">Subject:</label>
                <input type="text" id="subject" name="subject" placeholder="Enter subject">
                <br>
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="5" placeholder="Enter message"></textarea>
                <br>
                <button class="text-btn" type="submit">Send</button>
            </div>
        </div>
        <br>
    </form>
  </div>
</div>

