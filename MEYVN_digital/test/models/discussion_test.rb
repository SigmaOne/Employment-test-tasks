require 'test_helper'

class DiscussionTest < ActiveSupport::TestCase
  def setup
    @discussion = discussions(:discussion_1)
  end

  test 'topic and event should be preset' do
    assert @discussion.valid?

    @discussion.event = nil
    assert_not @discussion.valid?
    @discussion.event = events(:HNY)

    @discussion.topic = nil
    assert_not @discussion.valid?
    @discussion.topic = 'smthg'

    assert @discussion.valid?
  end
end
