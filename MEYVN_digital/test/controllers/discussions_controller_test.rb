require 'test_helper'

class DiscussionsControllerTest < ActionDispatch::IntegrationTest
  def setup
    @event = events(:HNY)
  end

  test 'should permit right only topic in discussions' do
    assert_difference '@event.discussions.count', 1 do
      post event_discussions_path(@event), params: { discussion: { topic: 'Is it workng?'} }
      p @event.discussions
    end
  end
end
