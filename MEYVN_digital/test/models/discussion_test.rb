require 'test_helper'

class DiscussionTest < ActiveSupport::TestCase
  def setup
    @event = Event.first
  end
  test 'topic should be preset' do
    assert_difference '@event.discussions.count', 1 do
      @event.discussions.create(topic: "What's up wth weather?")
    end
  end
end
